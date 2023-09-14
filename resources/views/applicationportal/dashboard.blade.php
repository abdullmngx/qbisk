@extends('layouts.appapp')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card radius-10">
            <div class="card-body">
                <div class="row justify-content-center mb-4">
                    <div class="col-4">
                        <div class="text-center">
                            <img src="{{ $user->passport ?? '/avatar.png' }}" alt="" class="img-fluid w-100">
                        </div>
                    </div>
                </div>
                <div class="text-center mb-4">
                    <h5>{{ auth('applicant')->user()->full_name }}</h5>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <p><strong>Admission Status: </strong> {{ ucwords($user->status) }}</p>
                        <p><strong>Admission Number: </strong> {{ $user->admission_number ?? 'NA' }}</p>
                        <p><strong>Applied Section: </strong> {{ ucwords($user->applied_section_name) }}</p>
                        <p><strong>Applied Class: </strong> {{ strtoupper($user->applied_form_name) }}</p>
                        <p><strong>Admitted Section: </strong> {{ $user->section_name ?? 'NA' }}</p>
                        <p><strong>Admitted Class: </strong> {{ $user->form_name ?? 'NA' }}</p>
                        <p><strong>Arm: </strong> {{ $user->arm_name ?? 'NA' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row">
            @foreach ($payments as $payment)
                <div class="col-6">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-2">
                                <div>
                                    <p class="mb-0 fs-6">{{ $payment->name }}</p>
                                </div>
                                <div class="ms-auto radius-10 p-2 text-white bg-{{ $payment->status == 'paid' ? 'success':'danger' }}">
                                    {{ $payment->status }}
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div>
                                    <h4 class="mb-0">NGN {{ $payment->amount }}</h4>
                                </div>
                                <div class="ms-auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--end row-->
    </div>
</div>


@endsection
