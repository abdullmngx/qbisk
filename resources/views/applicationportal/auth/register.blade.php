@extends('layouts.auth')
@section('title', 'Apply')
@section('content')
    <form class="theme-form login-form" method="post">
        @csrf
        <div class="text-center">
            <img src="{{ asset('logo.png') }}" class="img-fluid w-25" alt="Logo">
            <h4>{{ env('APP_NAME') }}</h4>
            <h6>Fill in the form below to begin.</h6>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" id="first_name" class="form-control">
                    @if ($errors->has('first_name'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="surname">Surname <span class="text-danger">*</span></label>
                    <input type="text" name="surname" id="surname" class="form-control">
                    @if ($errors->has('surname'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('surname') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <select name="gender" id="gender" class="form-control form-select">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">other</option>
                    </select>
                    @if ($errors->has('first_name'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="phone_number">Parent Phone Number <span class="text-danger">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                    @if ($errors->has('phone_number'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="email">Email (Parent/Student) <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control">
                    @if ($errors->has('email'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="section_id">Section <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-control form-select">
                        <option value="">Select section</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section['id'] }}">{{ $section['name'] }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('section_id'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('section_id') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="form_id">Form <span class="text-danger">*</span></label>
                    <select name="form_id" id="form_id" class="form-control form-select">
                        <option value="">Select Form</option>
                    </select>
                    @if ($errors->has('form_id'))
                        <span class="text-danger text-sm text-small">{{ $errors->first('form_id') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="arm_id">Arm</label>
                    <select name="arm_id" id="arm_id" class="form-control form-select">
                        <option value="">Select Arm</option>
                        @foreach ($arms as $arm)
                            <option value="{{ $arm['id'] }}">{{ $arm['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </div>
        <div class="col-12 col-lg-12 text-center">
            <p class="mb-0">Already applied? <a href="login">Continue application</a></p>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('#section_id').change(function () {
            $('#form_id').html('')
            let url = '/api/forms/getbysection'
            let requestData = {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({section_id: $(this).val()})
            }
            fetch(url, requestData).
            then(response => {
                if (!response.ok)
                {
                    console.log("response was not ok");
                }
                return response.json()
            }).
            then(data => {
                $('#form_id').append(`<option value="">Select form</option>`)
                data.forEach(form => {
                    $('#form_id').append(`<option value="${form.id}">${form.name}</option>`)
                });
            }).
            catch(error => {
                console.log(error)
            })
        })
    </script>
@endsection
