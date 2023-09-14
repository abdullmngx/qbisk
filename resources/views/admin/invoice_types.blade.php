@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Invoice Types')
@section('breadcrumb-main')
<li class="breadcrumb-item">Manage Payments</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@yield('title')</h4>
                    <div class="mb-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Invoice Type</button>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <div class="alert alert-danger">{{ $err }}</div>
                        @endforeach
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session()->get('message') }}</div>
                    @endif
                    <div class="mb-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover data-table">
                                <thead>
                                    <tr>
                                        <th class="bg-primary">S/No.</th>
                                        <th class="bg-danger">Session</th>
                                        <th class="bg-dark">Term</th>
                                        <th class="bg-info">Section</th>
                                        <th class="bg-warning">Class</th>
                                        <th class="bg-success">Arm</th>
                                        <th class="bg-danger">Payment Category</th>
                                        <th class="bg-light">Name</th>
                                        <th class="bg-primary">Amount</th>
                                        <th class="bg-info">Owner Type</th>
                                        <th class="bg-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice_types as $invoice_type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice_type->session }}</td>
                                        <td>{{ $invoice_type->term }}</td>
                                        <td>{{ $invoice_type->section }}</td>
                                        <td>{{ $invoice_type->form }}</td>
                                        <td>{{ $invoice_type->arm }}</td>
                                        <td>{{ $invoice_type->payment_category }}</td>
                                        <td>{{ $invoice_type->name }}</td>
                                        <td>{{ $invoice_type->amount }}</td>
                                        <td>{{ $invoice_type->owner_type }}</td>
                                        <td><a href="javascript:void" data-id="{{ $invoice_type->id }}" data-session="{{ $invoice_type->session_id }}" data-term="{{ $invoice_type->term_id }}" data-section="{{ $invoice_type->section_id }}" data-form="{{ $invoice_type->form_id }}" data-form_name="{{ $invoice_type->form }}" data-arm="{{ $invoice_type->arm_id }}" data-pay_cat="{{ $invoice_type->payment_category_id }}" data-name="{{ $invoice_type->name }}" data-amount="{{ $invoice_type->amount }}" data-owner_type="{{ $invoice_type->owner_type }}" class="btn btn-success up-btn">Update</a> <a href="javascript:void" data-id="{{ $invoice_type->id }}" class="btn btn-danger del-btn">Delete</a></td>
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
</div>
@endsection

@section('modals')
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Invoice Type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="grade-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="session">Session</label>
                                    <select name="session_id" id="session" class="form-control form-select opt">
                                        <option value="">Select Session</option>
                                        @foreach ($sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="term">Term</label>
                                    <select name="term_id" id="term" class="form-control form-select opt">
                                        <option value="">Select Term</option>
                                        @foreach ($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="section">Section</label>
                                    <select name="section_id" id="section" class="form-control form-select opt">
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="form">Class</label>
                                    <select name="form_id" id="form" class="form-control form-select">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="arm">Arm</label>
                                    <select name="arm_id" id="arm" class="form-control form-select opt">
                                        <option value="">Select Arm</option>
                                        @foreach ($arms as $arm)
                                            <option value="{{ $arm->id }}">{{ $arm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="payment_category">Payment Category</label>
                                    <select name="payment_category_id" id="payment_category" class="form-control form-select opt">
                                        <option value="">Select Payment Category</option>
                                        @foreach ($payment_categories as $payment_category)
                                            <option value="{{ $payment_category->id }}">{{ $payment_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="amount">Amount </label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="owner_type">Owner Type</label>
                            <select name="owner_type" id="owner_type" class="form-control form-select">
                                <option value="">Select Owner Type</option>
                                <option value="applicant">Applicant</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Add Invoice Type</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Invoice Type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/staff/payments/invoice-types/update" method="post" id="update-form">
                        @csrf
                        <input type="hidden" name="id" id="invoice_type_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="session_up">Session</label>
                                    <select name="session_id" id="session_up" class="form-control form-select opt">
                                        <option value="">Select Session</option>
                                        @foreach ($sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="term_up">Term</label>
                                    <select name="term_id" id="term_up" class="form-control form-select opt">
                                        <option value="">Select Term</option>
                                        @foreach ($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="section_up">Section</label>
                                    <select name="section_id" id="section_up" class="form-control opt">
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="form_up">Class</label>
                                    <select name="form_id" id="form_up" class="form-control">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="arm_up">Arm</label>
                                    <select name="arm_id" id="arm_up" class="form-control form-select opt">
                                        <option value="">Select Arm</option>
                                        @foreach ($arms as $arm)
                                            <option value="{{ $arm->id }}">{{ $arm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="payment_category_up">Payment Category</label>
                                    <select name="payment_category_id" id="payment_category_up" class="form-control form-select opt">
                                        <option value="">Select Payment Category</option>
                                        @foreach ($payment_categories as $payment_category)
                                            <option value="{{ $payment_category->id }}">{{ $payment_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="name_up">Name</label>
                            <input type="text" name="name" id="name_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="amount_up">Amount </label>
                            <input type="number" name="amount" id="amount_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="owner_type_up">Owner Type</label>
                            <select name="owner_type" id="owner_type_up" class="form-control form-select">
                                <option value="">Select Owner Type</option>
                                <option value="applicant">Applicant</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update Invoice Type</button>
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
    $('body').on('click', '.up-btn', function () {
        var modal = new bootstrap.Modal(document.getElementById('upModal'))
        var id = $(this).data('id')
        var session_id = $(this).data('session')
        var term_id = $(this).data('term')
        var section_id = $(this).data('section')
        var form_id = $(this).data('form')
        var arm_id = $(this).data('arm')
        var pay_cat_id = $(this).data('pay_cat')
        var name = $(this).data('name')
        var amount = $(this).data('amount')
        var owner_type = $(this).data('owner_type')
        var form_name = $(this).data('form_name')

        $('#invoice_type_id').val(id);
        $('#name_up').val(name);
        $('#amount_up').val(amount);

        var sectionOptions = document.getElementById('section_up').options
        for (var x = 0; x < sectionOptions.length; x++)
        {
            if (sectionOptions[x].value == section_id)
            {
                sectionOptions[x].selected = true
            }
        }
        var sessionOptions = document.getElementById('session_up').options
        for (var x = 0; x < sessionOptions.length; x++)
        {
            if (sessionOptions[x].value == session_id)
            {
                sessionOptions[x].selected = true
            }
        }

        var termOptions = document.getElementById('term_up').options
        for (var x = 0; x < termOptions.length; x++)
        {
            if (termOptions[x].value == term_id)
            {
                termOptions[x].selected = true
            }
        }

        var formOptions = document.getElementById('form_up').options
        for (var x = 0; x < formOptions.length; x++)
        {
            if (formOptions[x].value == form_id)
            {
                formOptions[x].selected = true
            }
        }

        var armOptions = document.getElementById('arm_up').options
        for (var x = 0; x < armOptions.length; x++)
        {
            if (armOptions[x].value == arm_id)
            {
                armOptions[x].selected = true
            }
        }

        var payCatOptions = document.getElementById('payment_category_up').options
        for (var x = 0; x < payCatOptions.length; x++)
        {
            if (payCatOptions[x].value == pay_cat_id)
            {
                payCatOptions[x].selected = true
            }
        }

        var ownerTypeOptions = document.getElementById('owner_type_up').options
        for (var x = 0; x < ownerTypeOptions.length; x++)
        {
            if (ownerTypeOptions[x].value == owner_type)
            {
                ownerTypeOptions[x].selected = true
            }
        }

        if (form_id)
        {
            $('#form_up').html(`<option value="">Select form</option><option value="${form_id}" selected>${form_name}</option>`)
        }

        modal.show()
    });

    $('body').on('click', '.del-btn', function () {
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Item!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                location.href = '/staff/payments/invoice-types/delete/' + id;
            } else {
                swal("Cancelled!");
            }
        })
    })
    $('.opt').change(function () {
        var section_id = $(this).val();
        $.ajax({
            url: '/api/get-forms/' + section_id,
            type: 'GET',
            success: function (data) {
                var forms = data;
                var options = '<option value="">Select class</option>';
                forms.forEach(form => {
                    options += '<option value="' + form.id + '">' + form.name + '</option>';
                })
                $('#form').html(options);
                $('#form_up').html(options)
            }
        })
    })
</script>
@endsection
