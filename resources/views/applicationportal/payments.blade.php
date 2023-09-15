@extends('layouts.appapp')
@include('partials.datatable')
@section('title', 'Payments')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">@yield('title')</h4>
                        @if ($errors->any())
                            @foreach ($errors->all() as $err)
                                <div class="alert alert-danger">{{ $err }}</div>
                            @endforeach
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @endif

                        @if (auth('applicant')->user()->final_submission == '1')
                            <div class="mb-4">
                                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#invoiceModal" class="btn btn-primary">Generate Invoice</a>
                            </div>
                        @else
                            <div class="mb-4 text-center">
                                <a href="{{ route('applicant.profile') }}" class="text-danger">please complete your profile to activate payment, click here</a>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover data-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Invoice Number</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Paid at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->amount }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>{{ $invoice->paid_at }}</td>
                                            <td><a href="/applicationportal/invoices/{{ $invoice->id }}" class="btn btn-primary btn-sm">View</a></td>
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

@section('modals')
    <div class="modal fade" id="invoiceModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Generate Invoice</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="grade-form">
                        @csrf
                        <div class="mb-4">
                            <label for="invoice_type">Invoice Type</label>
                            <select name="invoice_type_id" id="invoice_type" class="form-control form-select">
                                <option value="">Select Invoice Type</option>
                                @foreach ($payments as $payment)
                                    @if ($payment->status == 'unpaid')
                                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Generate Invoice </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.data-table').DataTable()
    </script>
@endsection
