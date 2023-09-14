@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <form class="theme-form login-form" method="post">
        @csrf
        <div class="text-center">
            <img src="{{ asset('logo.png') }}" class="img-fluid w-25" alt="Logo">
            <h4>{{ env('APP_NAME') }}</h4>
            <h6>Log in to your account.</h6>
        </div>
        <div class="col-12 col-lg-12">
            <div class="d-grid mb-4">
                <label for="username">Application Number</label>
                <input type="text" name="username" id="username" class="form-control">
                @if ($errors->has('username'))
                    <span class="text-danger text-sm text-small">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="d-grid mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter one of your names or password">
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
        <div class="col-12 col-lg-12 text-center">
            <p class="mb-0">New applicant? <a href="apply">Apply here</a></p>
        </div>
    </form>
@endsection
