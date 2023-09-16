@extends('layouts.sapp')
@include('partials.datatable')
@section('title', 'Invoice')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice #{{ $invoice->invoice_number }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="text-right">
                                <span class="bg-{{ $invoice->status == 'paid' ? 'success' : 'danger' }} badge p-2 text-lg">{{ $invoice->status }}</span>
                            </div>
                        </div>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <th>S/N</th>
                                    <th>Item Description</th>
                                    <th>Amount</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>{{ $invoice->invoice_type }}</td>
                                        <td>{{ number_format($invoice->amount,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>Total: {{ number_format($invoice->amount,2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4">
                            <a href="/student/invoices/print/{{ $invoice->id }}" class="btn btn-warning">Print</a>
                            @if ($invoice->status == "unpaid")
                                <button type="button" onclick="makePayment()" class="btn btn-success">Pay Now</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        function makePayment() {
            FlutterwaveCheckout({
                public_key: "{{ env('FLUTTERWAVE_PUBLIC') }}",
                tx_ref: "{{ $invoice->invoice_number }}",
                amount: {{ $invoice->amount }},
                currency: "NGN",
                payment_options: "card, banktransfer, ussd",
                redirect_url: "https://" +location.hostname + "/payment/done",
                customer: {
                    email: "{{ auth('student')->user()->email }}",
                    phone_number: "{{ auth('student')->user()->phone_number }}",
                    name: "{{ auth('student')->user()->full_name }}",
                },
                customizations: {
                    title: "Student {{ $invoice->invoice_type }}",
                    description: "Payment for student {{ $invoice->invoice_type }}",
                    logo: "https://" + location.hostname + "/logo.png",
                },
            });
        }
    </script>
@endsection
