@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Applicant')
@section('breadcrumb-main')
<li class="breadcrumb-item">Manage Applicants</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Applicant</h4>
                        <div class="mt-4">
                            <form enctype="multipart/form-data" method="post">
                                @csrf
                                <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ $applicant->passport }}" alt="" class="img-fluid w-50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="passport">Passport</label>
                                            <input type="file" name="passport" id="passport" class="form-control">
                                            @if($errors->has('passport'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('passport') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $applicant->first_name }}">
                                            @if($errors->has('first_name'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $applicant->middle_name }}">
                                        </div>
                                        <div class="mb-4">
                                            <label for="surname">Surname</label>
                                            <input type="text" name="surname" id="surname" class="form-control" value="{{ $applicant->surname }}">
                                            @if($errors->has('surname'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="dob">Date of birth</label>
                                            <input type="date" name="dob" id="dob" class="form-control" value="{{ $applicant->dob }}">
                                            @if($errors->has('dob'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">Select gender</option>
                                                <option value="male" {{ $applicant->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $applicant->gender == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            @if($errors->has('gender'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="religion">Religion</label>
                                            <select name="religion" id="religion" class="form-control">
                                                <option value="">Select religion</option>
                                                <option value="christianity" {{ $applicant->religion == 'christianity' ? 'selected' : '' }}>Christianity</option>
                                                <option value="islam" {{ $applicant->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="others" {{ $applicant->religion == 'others' ? 'selected' : '' }}>Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="disability">Disability</label>
                                            <select name="disability" id="disability" class="form-control form-select">
                                                @php
                                                    $disabilities = ['none', 'deaf', 'dumb', 'blind', 'crippled'];
                                                @endphp
                                                <option value="">Select Disability</option>
                                                @foreach ($disabilities as $disability)
                                                    <option value="{{ $disability }}" {{ $applicant->disability == $disability ? 'selected': '' }}>{{ ucfirst($disability) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="height">Height (in metres)</label>
                                            <input type="text" name="height" id="height" class="form-control" value="{{ $applicant->height }}">
                                            @if($errors->has('height'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('height') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="nationality">Nationality</label>
                                            <input type="text" name="nationality" id="nationality" class="form-control" value="{{ $applicant->nationality }}">
                                        </div>
                                        <div class="mb-4">
                                            <label for="state">State</label>
                                            <input type="text" name="state" id="state" class="form-control" value="{{ $applicant->state }}">
                                            @if($errors->has('state'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="lga">LGA</label>
                                            <input type="text" name="lga" id="lga" class="form-control" value="{{ $applicant->lga }}">
                                            @if($errors->has('lga'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('lga') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address"  class="form-control" >{{ $applicant->address }}</textarea>
                                            @if($errors->has('address'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="parent_name">Parent Name</label>
                                            <input type="text" name="parent_name" id="parent_name" class="form-control" value="{{ $applicant->parent_name }}">
                                            @if($errors->has('parent_name'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('parent_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="email">Parent Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $applicant->email }}">
                                            @if($errors->has('email'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone_number">Parent Phone No.</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $applicant->phone_number }}">
                                            @if($errors->has('phone_number'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="parent_occupation">Parent Occupation</label>
                                            <input type="text" name="parent_occupation" id="parent_occupation" class="form-control" value="{{ $applicant->parent_occupation }}">
                                        </div>
                                        <div class="mb-4">
                                            <label for="allergies">Allergies</label>
                                            <input type="text" name="allergies" id="allergies" class="form-control" value="{{ $applicant->allergies }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="blood_group">Blood Group</label>
                                            <select name="blood_group" id="blood_group" class="form-control form-select">
                                                <option value="">Select Blood Group</option>
                                                @php
                                                    $blood_groups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
                                                @endphp
                                                @foreach ($blood_groups as $blood_group)
                                                    <option value="{{ $blood_group }}" {{ $applicant->blood_group == $blood_group ? 'selected' : ''}}>{{ $blood_group }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('blood_group'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('blood_group') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="genotype">Genotype</label>
                                            <select name="genotype" id="genotype" class="form-control form-select">
                                                <option value="">Select Genotype</option>
                                                @php
                                                    $genotypes = ['AA', 'AS', 'SS'];
                                                @endphp
                                                @foreach ($genotypes as $genotype)
                                                    <option value="{{ $genotype }}" {{ $applicant->genotype == $genotype ? 'selected':'' }}>{{ $genotype }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('genotype'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('genotype') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="applied_form">Class Applied</label>
                                            <select name="applied_form_id" id="applied_form" class="form-control form-select">
                                                <option value="{{ $applicant->applied_form_id }}">{{ $applicant->applied_form_name }}</option>
                                            </select>
                                        </div>
                                        <h4>Admit Into</h4>
                                        <div class="mb-4">
                                            <label for="section_id">Section</label>
                                            <select name="section_id" id="section_id" class="form-control opt">
                                                <option value="">Select section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}" {{ $applicant->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('section_id'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('section_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="form_id">Class</label>
                                            <select name="form_id" id="form_id" class="form-control">
                                                <option value="{{ $applicant->form_id }}">{{ $applicant->form }}</option>
                                            </select>
                                            @if($errors->has('form_id'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('form_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="arm">Arm</label>
                                            <select name="arm_id" id="arm" class="form-control">
                                                <option value="">Select arm</option>
                                                @foreach ($arms as $arm)
                                                    <option value="{{ $arm->id }}" {{ $applicant->arm_id == $arm->id ? 'selected' : '' }}>{{ $arm->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('arm_id'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('arm_id') }}</span>
                                            @endif
                                        </div>
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">{{ session('message') }}</div>
                                        @endif
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary">Admit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                    $('#form_id').html(options);
                }
            })
        })
    </script>
@endsection

