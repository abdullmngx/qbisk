<?php

namespace App\Http\Controllers;

use App\Models\Arm;
use App\Models\InvoiceType;
use App\Models\PaymentCategory;
use App\Models\Section;
use App\Models\Session;
use App\Models\Term;
use Illuminate\Http\Request;

class InvoiceTypeController extends Controller
{
    public function index()
    {
        $invoice_types = InvoiceType::latest()->get();
        $sections = Section::all();
        $sessions = Session::all();
        $terms = Term::all();
        $payment_categories = PaymentCategory::all();
        $arms = Arm::all();
        return view('admin.invoice_types', ['invoice_types' => $invoice_types, 'sections' => $sections, 'sessions' => $sessions, 'terms' => $terms, 'payment_categories' => $payment_categories, 'arms' => $arms]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_category_id' => 'required',
            'name' => 'required',
            'amount'=> 'required',
            'owner_type'=> 'required',
        ]);

        $data = $request->except('_token');

        InvoiceType::unguard();
        InvoiceType::create($data);
        InvoiceType::reguard();
        return back()->with('message', 'Invoice Type added successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'payment_category_id' => 'required',
            'name' => 'required',
            'amount'=> 'required',
            'owner_type'=> 'required',
        ]);

        $data = $request->except('_token', 'id');
        InvoiceType::where('id', $request->id)->update($data);
        return back()->with('message', 'Invoice Type updated');
    }

    public function delete($id)
    {
        InvoiceType::where('id', $id)->delete();
        return back()->with('message','Deleted');
    }
}
