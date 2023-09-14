<?php

namespace App\Http\Controllers;

use App\Models\AdmissionCount;
use App\Models\Arm;
use App\Models\Card;
use App\Models\Configuration;
use App\Models\Form;
use App\Models\Invoice;
use App\Models\InvoiceType;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Term;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|numeric',
            'form_joined' => 'required',
            'section_id' => 'required',
            'form_id' => 'required',
            'arm_id' => 'required',
            'passport' => 'required'
        ]);

        $student = $request->except('_token');
        $file = $request->file('passport')->store('public/uploads');
        $passport = Storage::url($file);
        $student['passport'] = $passport;
        $student['password'] = Hash::make('0000');

        $config = Configuration::where('name', 'current_session')->first();
        try
        {
            DB::beginTransaction();
            if (!$request->admission_number)
            {
                $count = AdmissionCount::where('session_id', $config->value)->first()?->count ?? 0;
                $admission_number = 'QB/'.date('y').'/'.sprintf('%04d', $count+1);
                $student['admission_number'] = $admission_number;
                AdmissionCount::updateOrCreate(['session_id' => $config->value],['count' => $count+1]);
            }



            Student::unguard();
            Student::create($student);
            Student::reguard();

            DB::commit();
        }
        catch (Exception $e)
        {
            throw $e;
            DB::rollBack();
        }
        return back()->with('message', 'Student Added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|numeric',
            'form_joined' => 'required',
            'section_id' => 'required',
            'form_id' => 'required',
            'arm_id' => 'required',
        ]);

        $data = $request->except('_token', 'student_id', 'passport', 'admission_number');
        $student = Student::find($request->student_id);
        if ($request->file('passport'))
        {
            Storage::disk('local')->delete('public/'.$student->passport);
            $passport = $request->file('passport')->store('public/uploads');
            $data['passport'] = str_replace('public/', '', $passport);
        }
        Student::unguard();
        $student->update($data);
        Student::reguard();
        return back()->with('message', 'Student info updated!');
    }

    public function showLogin()
    {
        return view('auth.student_login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);

        $student = Student::where('admission_number', $request->username)->orWhere('email', $request->username)->first();
        if ($student && Hash::check($request->password, $student->password))
        {
            Auth::guard('student')->login($student, $request->remember);
            return redirect()->intended(route('student.dashboard'));
        }
        else
        {
            return back()->withErrors(['username' => 'username or password incorrect']);
        }
    }

    public function dashboard()
    {
        $student = auth('student')->user();
        $config = app('configs');
        $match_params = [
            'session_id' => $config['current_session'],
            'term_id' => $config['current_term'],
            'section_id' => $student->section_id,
            'form_id' => $student->form_id,
            'arm_id' => $student->arm_id,
            'owner_type' => 'student'
        ];

        $paid_invoices = Invoice::where('owner_type', 'student')
        ->where('session_id', $config['current_session'])
        ->where('term_id', $config['current_term'])
        ->where('owner_id', $student->id)
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
        return view('student.dashboard', ['student' =>  $student, 'payments' => $invoiceTypes]);
    }

    public function result()
    {
        $forms = Result::where('student_id', auth('student')->id())->distinct('form_id')->get(['form_id']);
        $arms = Result::where('student_id', auth('student')->id())->distinct('arm_id')->get(['arm_id']);;
        $sessions = Result::where('student_id', auth('student')->id())->distinct('session_id')->get(['session_id']);;
        $terms = Result::where('student_id', auth('student')->id())->distinct('term_id')->get(['term_id']);
        $config = Configuration::where('name', 'result_view')->first();
        return view('student.result', ['config' => $config, 'forms' => $forms, 'arms' => $arms, 'sessions' => $sessions, 'terms' => $terms]);
    }

    public function printResult(Request $request)
    {
        $request->validate([
            'form_id' => 'required',
            'arm_id' => 'required',
            'session_id' => 'required',
            'term_id' => 'required'
        ]);
        $student_id = auth('student')->id();
        $student = Student::where('id', $student_id)->with(['results' => function ($query) use ($request) {
            $query->where('session_id', $request->session_id);
            $query->where('term_id', $request->term_id);
            $query->where('form_id', $request->form_id);
            $query->where('arm_id', $request->arm_id);
        }])->first();

        //dd($student);
        $dompdf = Pdf::setOptions(['isRemoteEnabled' => true]);
        $meta = [
            'session' => Session::find($request->session_id)?->name,
            'term' => Term::find($request->term_id)?->name,
            'result_form' => Form::find($request->form_id)?->name
        ];
        if ($request->has('pin'))
        {
            $request->validate([
                'pin' => 'required',
                'serial' => 'required'
            ]);
            $pin = $request->pin;
            $serial = $request->serial;
            $card = Card::where('pin', $pin)->where('serial', $serial)->first();
            if (!$card || $card->status == 'used' || $card->usage == $card->max_use)
            {
                return back()->withErrors(['pin' => 'Invalid pin provided']);
            }
            $usage = $card->usage + 1;
            if ($usage < $card->max_use)
            {
                $status = 'using';
            }else
            {
                $status = 'used';
            }
            $card->update([
                'usage' => $usage,
                'status' => $status
            ]);
        }
        $pdf = $dompdf->loadView('printouts.result', ['student' => $student, 'meta' => $meta]);
        return $pdf->stream('result.pdf');
    }

    public function payments()
    {
        $student = auth('student')->user();
        $config = app('configs');
        $match_params = [
            'session_id' => $config['current_session'],
            'term_id' => $config['current_term'],
            'section_id' => $student->section_id,
            'form_id' => $student->form_id,
            'arm_id' => $student->arm_id,
            'owner_type' => 'student'
        ];

        $paid_invoices = Invoice::where('owner_type', 'student')
        ->where('session_id', $config['current_session'])
        ->where('term_id', $config['current_term'])
        ->where('owner_id', $student->id)
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

        $invoices = Invoice::where('owner_id', $student->id)
        ->where('owner_type', 'student')
        ->get();

        return view('student.payments', ['payments' => $invoiceTypes, 'invoices' => $invoices]);
    }

    public function generateInvoice(Request $request)
    {
        $request->validate([
            'invoice_type_id' => 'required'
        ]);

        $config = app('configs');
        $student = auth('student')->user();
        $invoiceType = InvoiceType::where('id', $request->invoice_type_id)->first();

        $invoice_data = [
            'session_id' => $config['current_session'],
            'term_id' => $config['current_term'],
            'form_id' => $student->form_id,
            'owner_id' => $student->id,
            'owner_type' => 'student',
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
        return view('student.invoice', ['invoice' => $invoice]);
    }

    public function printInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $dompdf = Pdf::setOptions(['isRemoteEnabled' => true]);
        $pdf = $dompdf->loadView('prints.invoice', ['invoice' => $invoice]);
        return $pdf->stream('invoice.pdf');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect(route('student.login'));
    }
}
