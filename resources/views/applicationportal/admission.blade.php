@extends('layouts.appapp')
@include('partials.datatable')
@section('title', 'Admission')
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
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="text-center">
                                    @if ($applicant->status == 'admitted')
                                        <h1 class="mb-4">
                                            <i class="fa fa-check-circle fa-4x text-success"></i>
                                        </h1>
                                        <h5>Congratulations you have been offered admission into {{ strtoupper($applicant->form_name) }}</h5>
                                    @else
                                        <h1 class="mb-4">
                                            <i class="fa fa-cancel-circle fa-4x text-danger"></i>
                                        </h1>
                                        <h5>You have not been admitted yet, please check back</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
