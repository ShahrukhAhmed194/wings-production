@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Membership Form - ' . ($settings_g['title'] ?? env('APP_NAME')),
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

            <form action="{{route('user.form')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card border-light shadow">
                    <div class="card-header">
                        <h6 class="d-inline-block mb-0">Personal Information</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="img_groupp uploaded_member_img_group">
                                    <div class="text-center">
                                        <img class="img-thumbnail uploaded_img uploaded_member_img"
                                             src="{{asset('img/user-img.jpg')}}">
                                    </div>

                                    <div class="form-group mt-2">
                                        <div class="custom-file text-left">
                                            <input type="file" class="custom-file-input image_upload" accept="image/*"
                                                   name="profile_image" required>
                                            <label class="custom-file-label"><b>Upload Profile*</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Full Name*</b></label>
                                    <input type="text" class="form-control" name="last_name" placeholder="full name"
                                           value="{{auth()->user()?auth()->user()->last_name:old('last_name')}}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Email*</b></label>

                                    <input type="email" class="form-control" value="{{auth()->user()->email}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Member Type*</b></label>

                                    <input type="text" class="form-control"
                                           value="{{auth()->user()->memberType?auth()->user()->memberType->name:''}}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{--
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Name in Bengali *</b></label>

                                    <input type="text" class="form-control" name="bengali_name"
                                           value="{{old('bengali_name')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Nick Name *</b></label>

                                    <input type="text" class="form-control" placeholder="nike name" name="nick_name"
                                           value="{{old('nick_name')}}" required>
                                </div>
                            </div>

                            ---}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Mobile Number*</b></label>

                                    <input type="number" class="form-control" placeholder="mobile number"
                                           name="mobile_number" value="{{old('mobile_number')}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>NID*</b></label>

                                    <input type="text" class="form-control" placeholder="NID/Passport Number"
                                           name="n_id" value="{{old('n_id')}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Session*</b></label>
                                    <input type="text" class="form-control" placeholder="session"
                                           name="academic_session" value="{{old('academic_session')}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Gender*</b></label>

                                    <select name="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" selected="">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Blood Group*</b></label>

                                    <select name="blood_group" class="form-control" required>
                                        <option value="">Select Blood Group</option>
                                        @foreach ($blood_groups as $blood_group)
                                            <option value="{{$blood_group}}">{{$blood_group}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Date of Birth *</b></label>
                                    <input type="date" class="form-control" name="dob" value="{{old('dob')}}" required>
                                </div>
                            </div>
                            {{--
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Place of Birth *</b></label>

                                    <input type="text" placeholder="Place of Birth" class="form-control"
                                           name="place_of_birth" value="{{old('place_of_birth')}}" required>
                                </div>
                            </div>
                            --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Facebook Link</b></label>

                                    <input type="text" placeholder="Facebook Link" class="form-control"
                                           name="facebook_link" value="{{old('facebook_link')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Father's Name *</b></label>

                                    <input type="text" placeholder="Father's Name" class="form-control"
                                           name="father_name" value="{{old('father_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Mother's Name *</b></label>

                                    <input type="text" placeholder="mother's Name" class="form-control"
                                           name="mother_name" value="{{old('mother_name')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Marital Status *</b></label>

                                    <select name="marital_status" class="form-control marital_status_input" required>
                                        <option value="Married" selected>Married</option>
                                        <option value="Unmarried">Unmarried</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widow/Widower">Widow/Widower</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="married_section">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Spouse Name *</b></label>

                                        <input type="text" placeholder="Spouse Name"
                                               class="form-control form-control-sm" name="spouse_name"
                                               value="{{old('spouse_name')}}" required>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Date of Birth</b></label>
                                        <input type="date" class="form-control" name="spouse_dob"
                                               value="{{old('spouse_dob')}}">
                                    </div>
                                </div>
                                --}}
                            </div>
                            {{--
                            <hr>
                            <h5 class="d-inline-block">Kids</h5>
                            <button class="btn btn-success btn-sm float-right new_kid_btn" type="button"><i
                                    class="fas fa-plus"></i> New Field
                            </button>

                            <div class="kids_inputs">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label><b>Name of Kid*</b></label>

                                            <input type="text" name="kid_name[]" class="form-control form-control-sm"
                                                   placeholder="Name of Kid" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><b>Date of Birth</b></label>
                                            <input type="date" class="form-control" name="kid_dob[]"
                                                   value="{{old('kid_dob')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-1 text-right">
                                        <label style="visibility: hidden">.</label>
                                        <br>
                                        <button class="btn btn-sm btn-danger btn-block remove_kid_field"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                </div>
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

                                    <input type="text" class="form-control" placeholder="Address" name="mailing_address"
                                           value="{{old('mailing_address')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>City*</b></label>

                                    <input type="text" class="form-control" placeholder="City" name="mailing_city"
                                           value="{{old('mailing_city')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>District*</b></label>

                                    <input type="text" class="form-control" placeholder="District"
                                           name="mailing_district" value="{{old('mailing_district')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Post Code*</b></label>

                                    <input type="text" class="form-control" placeholder="Post Code"
                                           name="mailing_post_code" value="{{old('mailing_post_code')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Country*</b></label>

                                    <input type="text" class="form-control" placeholder="Country" name="mailing_country"
                                           value="{{old('mailing_country')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Contact No:</b></label>

                                    <input type="number" class="form-control" placeholder="Contact No"
                                           name="contact_no_res" value="{{old('contact_no_res')}}">
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

                                    <input type="text" class="form-control" placeholder="Address"
                                           name="permanent_address" value="{{old('permanent_address')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>City*</b></label>

                                    <input type="text" class="form-control" placeholder="City" name="permanent_city"
                                           value="{{old('permanent_city')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>District*</b></label>

                                    <input type="text" class="form-control" placeholder="District"
                                           name="permanent_district" value="{{old('permanent_district')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Post Code*</b></label>

                                    <input type="text" class="form-control" placeholder="Post Code"
                                           name="permanent_post_code" value="{{old('permanent_post_code')}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Country*</b></label>

                                    <input type="text" class="form-control" placeholder="Country"
                                           name="permanent_country" value="Bangladesh" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-light mt-3 shadow">
                    <div class="card-header">
                        <h6 class="d-inline-block mb-0"> Organization/Company Details</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b> Organization/Company </b></label>

                                    <input type="text" class="form-control" placeholder="Organization/Company"
                                           name="organization" value="{{old('organization')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Designation</b></label>

                                    <input type="text" class="form-control" placeholder="Designation"
                                           name="organization_designation" value="{{old('organization_designation')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Phone No</b></label>

                                    <input type="number" class="form-control" placeholder="Phone No"
                                           name="organization_phone" value="{{old('organization_phone')}}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Organization/Company Address</b></label>

                                    <input type="text" class="form-control" placeholder="Organization/Company Address"
                                           name="organization_address" value="{{old('organization_address')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="yes" id="aggrement" required>
                            <label class="form-check-label" for="aggrement">
                                I promise to abide by the rules and regulations of the association.
                                I {{auth()->user()->full_name}} Would like to be a Member of this.
                            </label>
                        </div>

                        <button class="button button_md mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).on('change', '.marital_status_input', function () {
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

        $(document).on('click', '.new_kid_btn', function () {
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
                '<input type="date" class="form-control" name="kid_dob[]" value="{{old('kid_dob')}}" required>' +
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

        $(document).on('click', '.remove_kid_field', function () {
            $(this).closest('.row').remove();
        });
    </script>
@endsection
