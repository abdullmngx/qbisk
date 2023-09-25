@extends('layouts.appapp')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        Student Information
                    </h4>
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><img src="{{ $user->passport ? asset($user->passport) : '/avatar.png' }}" alt="avatar" class="avatar avatar-md w-25 img-fluid"></p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="picture">Passport</label>
                                        <input type="file" name="picture" id="picture" class="form-control">
                                        @if ($errors->has('picture'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('picture') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" class="form-control">
                                        @if ($errors->has('first_name'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" name="middle_name" id="middle_name" value="{{ $user->middle_name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="surname">Surname</label>
                                        <input type="text" name="surname" id="surname" value="{{ $user->surname }}" class="form-control">
                                        @if ($errors->has('surname'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('surname') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" id="dob" value="{{ $user->dob }}" class="form-control">
                                        @if ($errors->has('dob'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="gender">gender</label>
                                        <select name="gender" id="gender" class="form-control form-select">
                                            @php
                                                $genders = ['male', 'female', 'other'];
                                            @endphp
                                            @foreach ($genders as $gender)
                                                <option value="{{ $gender }}" {{ $user->gender == $gender ? 'selected': '' }}>{{ ucfirst($gender) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>Parent/Guardian Information</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="parent_name">Parent/Guardian Name</label>
                                        <input type="text" name="parent_name" id="parent_name" value="{{ $user->parent_name }}" class="form-control">
                                        @if ($errors->has('parent_name'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('parent_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="parent_occupation">Parent/Guardian Occupation</label>
                                        <input type="text" name="parent_occupation" id="parent_occupation" value="{{ $user->parent_occupation }}" class="form-control">
                                        @if ($errors->has('parent_occupation'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('parent_occupation') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="phone_number">Parent/Guardian Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" class="form-control">
                                        @if ($errors->has('phone_number'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>Contact Information</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nationality">Nationality</label>
                                        <input type="text" name="nationality" id="nationality" value="{{ $user->nationality }}" class="form-control">
                                        @if ($errors->has('nationality'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('nationality') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="state">State</label>
                                        <input type="text" name="state" id="state" value="{{ $user->state }}" class="form-control">
                                        @if ($errors->has('state'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="lga">LGA</label>
                                        <input type="text" name="lga" id="lga" value="{{ $user->lga }}" class="form-control">
                                        @if ($errors->has('lga'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('lga') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control">
                                        @if ($errors->has('address'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                                        @if ($errors->has('email'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="lga">Religion</label>
                                        <select name="religion" id="religion" class="form-control form-select">
                                            @php
                                                $religions = ['islam', 'christianity', 'other'];
                                            @endphp
                                            <option value="">Select Religion</option>
                                            @foreach ($religions as $religion)
                                                <option value="{{ $religion }}" {{ $user->religion == $religion ? 'selected' : '' }}>{{ $religion }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('religion'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('religion') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>Health Information</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="disability">Disability</label>
                                        <select name="disability" id="disability" class="form-control form-select">
                                            @php
                                                $disabilities = ['none', 'deaf', 'dumb', 'blind', 'crippled'];
                                            @endphp
                                            <option value="">Select Disability</option>
                                            @foreach ($disabilities as $disability)
                                                <option value="{{ $disability }}" {{ $user->disability == $disability ? 'selected' :'' }}>{{ ucfirst($disability) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('disability'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('disability') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="blood_group">Blood Group</label>
                                        <select name="blood_group" id="blood_group" class="form-control form-select">
                                            <option value="">Select Blood Group</option>
                                            @php
                                                $blood_groups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
                                            @endphp
                                            @foreach ($blood_groups as $blood_group)
                                                <option value="{{ $blood_group }}" {{ $user->blood_group == $blood_group ? 'selected' :'' }}>{{ $blood_group }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('blood_group'))
                                            <span class="text-danger text-sm text-small">{{ $errors->first('blood_group') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="genotype">Genotype</label>
                                        <select name="genotype" id="genotype" class="form-control form-select">
                                            <option value="">Select Genotype</option>
                                            @php
                                                $genotypes = ['AA', 'AS', 'SS'];
                                            @endphp
                                            @foreach ($genotypes as $genotype)
                                                <option value="{{ $genotype }}" {{ $user->genotype == $genotype ? 'selected' :'' }}>{{ $genotype }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('genotype'))
                                            <span class="text-danger text-sm text-small">{{ $errors->first('genotype') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="allergies">Allergies</label>
                                        <input type="text" name="allergies" id="allergies" class="form-control" value="{{ $user->allergies }}">
                                        @if ($errors->has('allergies'))
                                            <span class="text-sm text-small text-danger">{{ $errors->first('allergies') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="height">Height (in metres)</label>
                                        <input type="text" name="height" id="height" class="form-control" value="{{ $user->height }}">
                                        @if($errors->has('height'))
                                            <span class="text-danger text-sm text-small">{{ $errors->first('height') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary">Update Information</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
