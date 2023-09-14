@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Confirm Payments')
@section('breadcrumb-main')
<li class="breadcrumb-item">Manage Payments</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4 card-title">Confirm Payment</h4>
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered tb">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Admission/Application Number</th>
                                        <th>Invoice Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $invoice->owner_type == 'applicant' ? $invoice->owner->application_number : $invoice->owner->admission_number }}</td>
                                            <td>{{ $invoice->invoice_type }}</td>
                                            <td>{{ $invoice->amount }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>
                                                @if ($invoice->status == 'unpaid')
                                                    <a href="{{ route('staff.confirm_invoice', $invoice->id) }}" class="btn btn-primary">Mark as paid</a>
                                                @else
                                                    No Action
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.tb').DataTable()
    </script>
@endsection

