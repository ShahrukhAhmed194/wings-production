@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Edit Profile - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        @if(isset($errors))
            @include('extra.error-validation')
        @endif
        @if(session('success'))
            @include('extra.success')
        @endif
        @if(session('error'))
            @include('extra.error')
        @endif

        <form action="{{route('user.profileEdit')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card border-light shadow">
                <div class="card-header">
                    <a href="{{route('userDashboard')}}" class="button button_md float-left">Back</a>
                    <h6 class="text-center">Personal Information</h6>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="img_groupp uploaded_member_img_group">
                                <div class="text-center">
                                    <img class="img-thumbnail uploaded_img uploaded_member_img" src="{{auth()->user()->profile_path}}">
                                </div>

                                <div class="form-group mt-2">
                                    <div class="custom-file text-left">
                                        <input type="file" class="custom-file-input image_upload" accept="image/*" name="profile_image">
                                        <label class="custom-file-label"><b>Upload Profile</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Full Name*</b></label>

                                <input type="text" class="form-control" name="last_name" value="{{old('full_name') ?? auth()->user()->full_name}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Email*</b></label>

                                <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{--
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Name in Bengali*</b></label>

                                <input type="text" class="form-control" name="bengali_name" value="{{old('bengali_name') ?? auth()->user()->bengali_name}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Nick Name*</b></label>

                                <input type="text" class="form-control" name="nick_name" value="{{old('nick_name') ?? auth()->user()->nick_name}}" required>
                            </div>
                        </div>
                        --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>NID*</b></label>

                                <input type="text" class="form-control" placeholder="NID/Passport Number"
                                       name="n_id" value="{{old('n_id')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Mobile Number*</b></label>

                                <input type="text" class="form-control" name="mobile_number" value="{{old('mobile_number') ?? auth()->user()->mobile_number}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Session*</b></label>
                                <input type="text" class="form-control" placeholder="session" name="academic_session" value="{{old('academic_session')}}" required>
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Hall</b></label>

                                <select name="hall" class="form-control">
                                    <option value="">Select Hall</option>
                                    @foreach ($halls as $hall)
                                        <option value="{{$hall}}" {{$hall == auth()->user()->hall ? 'selected' : ''}}>{{$hall}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Gender*</b></label>

                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{auth()->user()->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{auth()->user()->gender == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Blood Group*</b></label>

                                <select name="blood_group" class="form-control" required>
                                    <option value="">Select Blood Group</option>
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{$blood_group}}" {{$blood_group == auth()->user()->blood_group ? 'selected' : ''}}>{{$blood_group}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Date of Birth*</b></label>
                                <input type="date" class="form-control" name="dob" value="{{old('dob') ?? auth()->user()->dob }}" required>
                            </div>
                        </div>
                        {{--
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Place of Birth*</b></label>

                                <input type="text" class="form-control" name="place_of_birth" value="{{old('place_of_birth') ?? auth()->user()->place_of_birth}}" required>
                            </div>
                        </div>
                        --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Facebook Link</b></label>

                                <input type="text" class="form-control" name="facebook_link" value="{{old('facebook_link') ?? auth()->user()->facebook_link}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Father's Name*</b></label>

                                <input type="text" class="form-control" name="father_name" value="{{old('father_name') ?? auth()->user()->father_name}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Mother's Name *</b></label>

                                <input type="text" placeholder="mother's Name" class="form-control"
                                       name="mother_name" value="{{old('mother_name')}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Marital Status*</b></label>

                                <select name="marital_status" class="form-control marital_status_input" required>
                                    <option value="Married" {{auth()->user()->marital_status == 'Married' ? 'selected' : ''}}>Married</option>
                                    <option value="Unmarried" {{auth()->user()->marital_status == 'Unmarried' ? 'selected' : ''}}>Unmarried</option>
                                    <option value="Divorced" {{auth()->user()->marital_status == 'Divorced' ? 'selected' : ''}}>Divorced</option>
                                    <option value="Widow/Widower" {{auth()->user()->marital_status == 'Widow/Widower' ? 'selected' : ''}}>Widow/Widower</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="married_section" style="{{auth()->user()->marital_status == 'Unmarried' ? 'display:none' : ''}}">
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Spouse Name*</b></label>

                                    <input type="text" class="form-control form-control-sm" name="spouse_name" value="{{old('spouse_name') ?? auth()->user()->spouse_name}}" {{auth()->user()->marital_status != 'Unmarried' ? 'required' : ''}}>
                                </div>
                            </div>
                            {{--
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Date of Birth*</b></label>
                                    <input type="date" class="form-control" name="spouse_dob" value="{{old('spouse_dob') ?? auth()->user()->spouse_dob}}" required>
                                </div>
                            </div>
                            --}}
                        </div>
                        {{--
                        <hr>
                        <h5 class="d-inline-block">Kids</h5>
                        <button class="btn btn-success btn-sm float-right new_kid_btn" type="button"><i class="fas fa-plus"></i> New Field</button>

                        <div class="kids_inputs">
                            @foreach (auth()->user()->UserKids as $user_kid)
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><b>Name of Kid*</b></label>

                                        <input type="text" name="kid_name[]" class="form-control form-control-sm" placeholder="Name of Kid" value="{{$user_kid->name}}" {{auth()->user()->marital_status != 'Unmarried' ? 'required' : ''}}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Date of Birth*</b></label>
                                        <input type="date" class="form-control" name="kid_dob[]" value="{{$user_kid->dob}}" required>
                                    </div>
                                </div>

                                <div class="col-md-1 text-right">
                                    <label style="visibility: hidden">.</label>
                                    <br>
                                    <button class="btn btn-sm btn-danger btn-block remove_kid_field"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        --}}
                    </div>
                </div>
            </div>

            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <h6 class="d-inline-block mb-0">Mailing Address</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Address*</b></label>

                                <input type="text" class="form-control" name="mailing_address" value="{{old('mailing_address') ?? auth()->user()->mailing_address}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>City*</b></label>

                                <input type="text" class="form-control" name="mailing_city" value="{{old('mailing_city') ?? auth()->user()->mailing_city}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>District*</b></label>

                                <input type="text" class="form-control" name="mailing_district" value="{{old('mailing_district') ?? auth()->user()->mailing_district}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Post Code*</b></label>

                                <input type="text" class="form-control" name="mailing_post_code" value="{{old('mailing_post_code') ?? auth()->user()->mailing_post_code}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Country*</b></label>

                                <input type="text" class="form-control" name="mailing_country" value="{{old('mailing_country') ?? auth()->user()->mailing_country}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Contact No: Res</b></label>

                                <input type="text" class="form-control" name="contact_no_res" value="{{old('contact_no_res') ?? auth()->user()->contact_no_res}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <h6 class="d-inline-block mb-0">Permanent Address</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Address*</b></label>

                                <input type="text" class="form-control" name="permanent_address" value="{{old('permanent_address') ?? auth()->user()->permanent_address}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>City*</b></label>

                                <input type="text" class="form-control" name="permanent_city" value="{{old('permanent_city') ?? auth()->user()->permanent_city}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>District*</b></label>

                                <input type="text" class="form-control" name="permanent_district" value="{{old('permanent_district') ?? auth()->user()->permanent_district}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Post Code*</b></label>

                                <input type="text" class="form-control" name="permanent_post_code" value="{{old('permanent_post_code') ?? auth()->user()->permanent_post_code}}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Country*</b></label>

                                <input type="text" class="form-control" name="permanent_country" value="{{old('permanent_country') ?? auth()->user()->permanent_country}}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <h6 class="d-inline-block mb-0">Organization Details</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Organization</b></label>

                                <input type="text" class="form-control" name="organization" value="{{old('organization') ?? auth()->user()->organization}}" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Present Status/Designation</b></label>

                                <input type="text" class="form-control" name="organization_designation" value="{{old('organization_designation') ?? auth()->user()->organization_designation}}" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Phone No</b></label>

                                <input type="text" class="form-control" name="organization_phone" value="{{old('organization_phone') ?? auth()->user()->organization_phone}}" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Organization Address</b></label>

                                <input type="text" class="form-control" name="organization_address" value="{{old('organization_address') ?? auth()->user()->organization_address}}" >
                            </div>
                        </div>
                    </div>

                    <button class="button button_md mt-3">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).on('change', '.marital_status_input', function(){
            let marital_status = $(this).val();

            if (marital_status === 'Unmarried') {
                $('.married_section').hide();
                $('.married_section input').removeAttr('required', 'required');
                $('.married_section select').removeAttr('required', 'required');
            } else {
                $('.married_section').show();
                $('.married_section input').attr('required', 'required');
                $('.married_section select').attr('required', 'required');
            }
        });

        $(document).on('click', '.new_kid_btn', function(){
            let kid_html = '<div class="row">' +
                                '<div class="col-md-5">' +
                                    '<div class="form-group">' +
                                        '<label><b>Name of Kid*</b></label>' +

                                        '<input type="text" name="kid_name[]" class="form-control form-control-sm" placeholder="Name of Kid" required>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-md-6">' +
                                    '<div class="form-group">' +
                                        '<label><b>Date of Birth*</b></label>' +
                                        '<input type="date" class="form-control" name="kid_dob[]" value="{{old('kid_dob')}}" required>'+
                                    '</div>' +
                                '</div>' +

                                '<div class="col-md-1 text-right">' +
                                    '<label style="visibility: hidden">.</label>' +
                                    '<br>' +
                                    '<button class="btn btn-sm btn-danger btn-block remove_kid_field"><i class="fas fa-trash"></i></button>' +
                                '</div>' +
                            '</div>';

            $('.kids_inputs').append(kid_html);
        });

        $(document).on('click', '.remove_kid_field', function(){
            $(this).closest('.row').remove();
        });
    </script>
@endsection
