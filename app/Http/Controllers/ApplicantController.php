<?php

namespace App\Http\Controllers;

use App\Models\AdmissionCount;
use App\Models\Applicant;
use App\Models\Arm;
use App\Models\Invoice;
use App\Models\InvoiceType;
use App\Models\Section;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "first_name" => 'required',
            "surname" => 'required',
            "gender" => 'required',
            "email" => 'required|email',
            "phone_number" => 'required',
            "section_id" => "required",
            "form_id" => "required",
        ]);
        $config = app('configs');
        $year = date("y");
        $lastApplicant = Applicant::where('session_id', $config["current_session"])->latest()->first();
        $nextNumber = ($lastApplicant) ? intval(substr($lastApplicant->application_number, -4)) + 1 : 1;
        $nextNumberPadded = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        $application_number = "AP/{$year}/{$nextNumberPadded}";
        $applicant_details = $request->except('_token', 'section_id', 'form_id','arm_id');
        $password = Hash::make('0000');
        $applicant_details['session_id'] = $config['current_session'];
        $applicant_details['term_id'] = $config['current_term'];
        $applicant_details['application_number'] = $application_number;
        $applicant_details['password'] = $password;
        $applicant_details['applied_section_id'] = $request->section_id;
        $applicant_details['applied_form_id'] = $request->form_id;
        $applicant_details['applied_arm_id'] = $request->arm_id;
        $applicant = Applicant::create($applicant_details);
        Auth::guard('applicant')->login($applicant);
        return redirect(route('applicant.dashboard'));
    }

    public function index()
    {
        $sections = Section::all();
        $arms = Arm::all();
        return view('applicationportal.auth.register', ['sections' => $sections, 'arms' => $arms]);
    }

    public function login()
    {
        return view('applicationportal.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        $applicant = Applicant::where('application_number', $username)
        ->first();
        if ($applicant)
        {
            if ($applicant->first_name == $password || $applicant->middle_name == $password || $applicant->surname == $password || Hash::check($password, $applicant->password))
            {
                Auth::guard("applicant")->login($applicant);
                if ($applicant->status == 'admitted')
                {
                    $this->migrateApplicant($applicant);
                }
                return redirect()->intended(route('applicant.dashboard'));
            }
        }
        return back()->withErrors(["username" => "incorrect credentials"]);
    }

    protected function migrateApplicant($applicant)
    {
        if (!Student::where('application_id', $applicant->id)->exists())
        {
            $config = app('configs');
            $info = collect($applicant->toArray())->except('id', 'application_number', 'status', 'health_status', 'health_status_description', 'final_submission');
            $admissionCount = AdmissionCount::first();
            $count = $admissionCount?->count ?? 0;
            $admission_number = 'QB/'.date('y').'/'.sprintf('%04d', $count+1);
            $info['admission_number'] = $admission_number;
            $info['form_joined'] = $applicant->form_id;
            $info['application_id'] = $applicant->id;
            AdmissionCount::updateOrCreate(['id', $admissionCount?->id],['count' => $count+1]);

            $info = $info->toArray();

            Student::unguard();
            Student::create($info);
            Student::reguard();
        }
    }

    public function dashboard()
    {
        $user = auth('applicant')->user();
        $config = app('configs');
        $match_params = [
            'session_id' => $config['current_session'],
            'term_id' => $config['current_term'],
            'section_id' => $user->applied_section_id,
            'form_id' => $user->applied_form_id,
            'arm_id' => $user->applied_arm_id,
            'owner_type' => 'applicant'
        ];
        $paid_invoices = Invoice::where('owner_type', 'applicant')
        ->where('session_id', $config['current_session'])
        ->where('term_id', $config['current_term'])
        ->where('owner_id', $user->id)
        ->where('status', 'paid')
        ->pluck('invoice_type_id')
        ->toArray();
        $invoiceTypes = InvoiceType::match($match_params)->get();
        $invoiceTypes->filter(function ($invoiceType) use ($paid_invoices) {
            if (in_array($invoiceType->id, $paid_invoices))
            {
                $invoiceType->status = 'paid';
            }
            else
            {
                $invoiceType->status = 'unpaid';
            }
        });
        return view('applicationportal.dashboard', ['user' => $user, 'payments' => $invoiceTypes]);
    }

    public function profile()
    {
        $user = auth("applicant")->user();
        return view("applicationportal.profile", ["user" => $user]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "picture" => 'required|max:104',
            "first_name" => 'required',
            "surname" => 'required',
            "dob" => 'required',
            "gender" => 'required',
            "parent_name" => "required",
            "parent_occupation" => "required",
            "phone_number" => 'required',
            "nationality" => "required",
            "state" => 'required',
            'lga' => 'required',
            'address' => 'required',
            "email" => 'required|email',
            "religion" => "required",
            "disability" => "required",
            "blood_group" => "required",
            "genotype" => "required",
            "allergies" => "required",
            "height" => "required"
        ]);

        $applicant_info = $request->except('_token', 'picture');
        $file = $request->file('picture')->store('public/uploads');
        $passport = Storage::url($file);
        $applicant_info['passport'] = $passport;
        $applicant_info['final_submission'] = 1;
        Applicant::where('id', auth('applicant')->id())->update($applicant_info);
        return back()->with('success', 'Information has been saved');
    }

    public function payments()
    {
        $user = auth('applicant')->user();
        $config = app('configs');
        $match_params = [
            'session_id' => $config['current_session'],
            'term_id' => $config['current_term'],
            'section_id' => $user->applied_section_id,
            'form_id' => $user->applied_form_id,
            'arm_id' => $user->applied_arm_id,
            'owner_type' => 'applicant'
        ];

        $paid_invoices = Invoice::where('owner_type', 'applicant')
        ->where('session_id', $config['current_session'])
        ->where('term_id', $config['current_term'])
        ->where('owner_id', $user->id)
        ->where('status', 'paid')
        ->pluck('invoice_type_id')
        ->toArray();
        $invoiceTypes = InvoiceType::match($match_params)->get();
        $invoiceTypes->filter(function ($invoiceType) use ($paid_invoices) {
            if (in_array($invoiceType->id, $paid_invoices))
            {
                $invoiceType->status = 'paid';
            }
            else
            {
                $invoiceType->status = 'unpaid';
            }
        });

        $invoices = Invoice::where('owner_id', $user->id)
        ->where('owner_type', 'applicant')
        ->get();

        return view('applicationportal.payments', ['payments' => $invoiceTypes, 'invoices' => $invoices]);
    }

    public function generateInvoice(Request $request)
    {
        $request->validate([
            'invoice_type_id' => 'required'
        ]);

        $config = app('configs');
        $user = auth('applicant')->user();
        $invoiceType = InvoiceType::where('id', $request->invoice_type_id)->first();

        $invoice_data = [
            'session_id' => $config['current_session'],
            'term_id' => $config['current_term'],
            'form_id' => $user->applied_form_id,
            'owner_id' => $user->id,
            'owner_type' => 'applicant',
            'invoice_type_id' => $invoiceType->id,
            'amount' => $invoiceType->amount,
            'invoice_number' => $this->generateInvoiceNumber(),
        ];

        Invoice::unguard();
        Invoice::create($invoice_data);
        Invoice::reguard();

        return back()->with('message', 'Invoice generated');
    }

    protected function generateInvoiceNumber()
    {
        return rand(10, 99).date('sdmhyi');
    }

    public function viewInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        return view('applicationportal.invoice', ['invoice' => $invoice]);
    }

    public function printInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $dompdf = Pdf::setOptions(['isRemoteEnabled' => true]);
        $pdf = $dompdf->loadView('prints.invoice', ['invoice' => $invoice]);
        return $pdf->stream('invoice.pdf');
    }

    public function admission()
    {
        return view('applicationportal.admission', ['applicant' => auth('applicant')->user()]);
    }

    public function logout()
    {
        Auth::guard('applicant')->logout();
        return redirect(route('applicant.login'));
    }
}
