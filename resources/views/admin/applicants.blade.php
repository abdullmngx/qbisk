@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Applicants')
@section('breadcrumb-main')
<li class="breadcrumb-item">Manage Applicants</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4 card-title">Applicants</h4>
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered tb">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Application Number</th>
                                        <th>Name</th>
                                        <th>Class Applied</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicants as $applicant)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $applicant->application_number }}</td>
                                            <td>{{ $applicant->full_name }}</td>
                                            <td>{{ $applicant->applied_form_name }}</td>
                                            <td>{{ $applicant->payment_status }}</td>
                                            <td>
                                                <a href="/staff/applicants/{{ $applicant->id }}" class="btn btn-primary">View</a>
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

