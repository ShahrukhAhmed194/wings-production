@extends('back.layouts.master')
@section('title', 'Edit Member')

@section('master')
<form action="{{route('back.members.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <h5 class="d-inline-block">Personal Information</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="img_groupp uploaded_member_img_group">
                        <div class="text-center">
                            <img class="img-thumbnail uploaded_img uploaded_member_img" src="{{$user->profile_path}}">
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

                        <input type="text" class="form-control" name="last_name" value="{{old('full_name') ?? $user->full_name}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Email*</b></label>

                        <input type="email" class="form-control" name="email" value="{{old('email') ?? $user->email}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>NID/Passport</b></label>

                        <input type="text" class="form-control" name="n_id" value="{{old('n_id') ?? $user->n_id}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Session*</b></label>
                        <input type="text" class="form-control" placeholder="session"
                               name="academic_session" value="{{old('academic_session') ?? $user->academic_session}}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                {{--
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Name in Bengali</b></label>

                        <input type="text" class="form-control" name="bengali_name" value="{{old('bengali_name') ?? $user->bengali_name}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Nick Name</b></label>

                        <input type="text" class="form-control" name="nick_name" value="{{old('nick_name') ?? $user->nick_name}}">
                    </div>
                </div>
                --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Mobile Number</b></label>

                        <input type="text" class="form-control" name="mobile_number" value="{{old('mobile_number') ?? $user->mobile_number}}">
                    </div>
                </div>
                {{--                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Hall</b></label>

                        <select name="hall" class="form-control">
                            <option value="">Select Hall</option>
                            @foreach ($halls as $hall)
                                <option value="{{$hall}}" {{$hall == $user->hall ? 'selected' : ''}}>{{$hall}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Gender</b></label>

                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" {{$user->gender == 'Male' ? 'selected' : ''}}>Male</option>
                            <option value="Female" {{$user->gender == 'Female' ? 'selected' : ''}}>Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Blood Group</b></label>

                        <select name="blood_group" class="form-control">
                            <option value="">Select Blood Group</option>
                            @foreach ($blood_groups as $blood_group)
                                <option value="{{$blood_group}}" {{$blood_group == $user->blood_group ? 'selected' : ''}}>{{$blood_group}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Date of Birth</b></label>

                        <input type="date" class="form-control" name="dob" value="{{old('dob') ?? date('Y-m-d', strtotime($user->dob))}}">
                    </div>
                </div>
                {{--
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Place of Birth</b></label>

                        <input type="text" class="form-control" name="place_of_birth" value="{{old('place_of_birth') ?? $user->place_of_birth}}">
                    </div>
                </div>
                --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Facebook Link</b></label>

                        <input type="text" class="form-control" name="facebook_link" value="{{old('facebook_link') ?? $user->facebook_link}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Father's Name</b></label>

                        <input type="text" class="form-control" name="father_name" value="{{old('father_name') ?? $user->father_name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Mother's Name</b></label>

                        <input type="text" class="form-control" name="mother_name" value="{{old('mother_name') ?? $user->mother_name}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Marital Status*</b></label>

                        <select name="marital_status" class="form-control marital_status_input" required>
                            <option value="Married" {{$user->marital_status == 'Married' ? 'selected' : ''}}>Married</option>
                            <option value="Unmarried" {{$user->marital_status == 'Unmarried' ? 'selected' : ''}}>Unmarried</option>
                            <option value="Divorced" {{$user->marital_status == 'Divorced' ? 'selected' : ''}}>Divorced</option>
                            <option value="Widow/Widower" {{$user->marital_status == 'Widow/Widower' ? 'selected' : ''}}>Widow/Widower</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="married_section" style="{{$user->marital_status == 'Unmarried' ? 'display:none' : ''}}">
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Spouse Name*</b></label>

                            <input type="text" class="form-control" name="spouse_name" value="{{old('spouse_name') ?? $user->spouse_name}}" style="{{$user->marital_status == 'Unmarried' ? '' : 'required'}}">
                        </div>
                    </div>
                    {{--
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Date of Birth*</b></label>

                            <input type="date" class="form-control" name="spouse_dob" value="{{old('spouse_dob') ?? date('Y-m-d', strtotime($user->spouse_dob))}}" style="{{$user->marital_status == 'Unmarried' ? '' : 'required'}}">
                        </div>
                    </div>
                    --}}
                </div>
                {{--
                <hr>
                <h5 class="d-inline-block">Kids</h5>
                <button class="btn btn-success btn-sm float-right new_kid_btn" type="button"><i class="fas fa-plus"></i> New Field</button>

                <div class="kids_inputs">
                    @foreach ($user->UserKids as $kid)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Name of Kid*</b></label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger remove_kid_field"><i class="fas fa-trash"></i></button>
                                        </div>

                                        <input type="text" name="kid_name[]" value="{{$kid->name}}" class="form-control fix-rounded-right" placeholder="Name of Kid" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Date of Birth*</b></label>

                                    <input type="date" class="form-control" name="kid_dob[]" value="{{date('Y-m-d', strtotime($kid->dob))}}" required>
                                </div>
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
            <h5 class="d-inline-block">Mailing Address</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Address</b></label>

                        <input type="text" class="form-control" name="mailing_address" value="{{old('mailing_address') ?? $user->mailing_address}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>City</b></label>

                        <input type="text" class="form-control" name="mailing_city" value="{{old('mailing_city') ?? $user->mailing_city}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>District</b></label>

                        <input type="text" class="form-control" name="mailing_district" value="{{old('mailing_district') ?? $user->mailing_district}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Post Code</b></label>

                        <input type="text" class="form-control" name="mailing_post_code" value="{{old('mailing_post_code') ?? $user->mailing_post_code}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Country</b></label>

                        <input type="text" class="form-control" name="mailing_country" value="{{old('mailing_country') ?? $user->mailing_country}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Contact No: Res</b></label>

                        <input type="text" class="form-control" name="contact_no_res" value="{{old('contact_no_res') ?? $user->contact_no_res}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <h5 class="d-inline-block">Permanent Address</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Address</b></label>

                        <input type="text" class="form-control" name="permanent_address" value="{{old('permanent_address') ?? $user->permanent_address}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>City</b></label>

                        <input type="text" class="form-control" name="permanent_city" value="{{old('permanent_city') ?? $user->permanent_city}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>District</b></label>

                        <input type="text" class="form-control" name="permanent_district" value="{{old('permanent_district') ?? $user->permanent_district}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Post Code</b></label>

                        <input type="text" class="form-control" name="permanent_post_code" value="{{old('permanent_post_code') ?? $user->permanent_post_code}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Country</b></label>

                        <input type="text" class="form-control" name="permanent_country" value="{{old('permanent_country') ?? $user->permanent_country}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <h5 class="d-inline-block">Organization Details</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Organization</b></label>

                        <input type="text" class="form-control" name="organization" value="{{old('organization') ?? $user->organization}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Present Status/Designation</b></label>

                        <input type="text" class="form-control" name="organization_designation" value="{{old('organization_designation') ?? $user->organization_designation}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Phone No</b></label>

                        <input type="text" class="form-control" name="organization_phone" value="{{old('organization_phone') ?? $user->organization_phone}}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Organization Address</b></label>

                        <input type="text" class="form-control" name="organization_address" value="{{old('organization_address') ?? $user->organization_address}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <h5 class="d-inline-block">Additional Information</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Status*</b></label>

                        <select name="status" class="form-control" required>
                            <option value="pending" {{$user->status == 'pending' ? 'selected' : ''}}>Pending</option>
                            <option value="canceled" {{$user->status == 'canceled' ? 'selected' : ''}}>Canceled</option>
                            <option value="approved" {{$user->status == 'approved' ? 'selected' : ''}}>Approved</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Member Type *</b></label>

                        <select name="member_type_id" class="form-control" required>
                            @foreach($member_types as $member_type)
                                <option value="{{$member_type->id}}" {{$user->member_type_id == $member_type->id ? 'selected' : ''}}>{{ $member_type->name.'-' .$member_type->amount}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{--                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Amount *</b></label>

                        <input type="text" class="form-control" name="amount" value="{{old('amount') ?? $user->amount}}" required>
                    </div>
                </div>--}}

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Payment Status*</b></label>

                        <select name="payment_status" class="form-control" disabled>
                            <option value="paid" {{$user->payment_status == 'paid' ? 'selected' : ''}}>Paid</option>
                            <option value="unpaid" {{$user->payment_status == 'unpaid' ? 'selected' : ''}}>Unpaid</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Payment Transaction Number</b></label>

                        <input type="text" class="form-control" name="payment_trx_number" value="{{old('payment_trx_number') ?? $user->payment_trx_number}}" readonly>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Update Note*</b></label>

                        <textarea name="update_note" class="form-control" cols="30" rows="5" required>{{old('update_note') ?? $user->update_note}}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-success btn-lg">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>
@endsection

@section('footer')
<script>
    $(document).on('change', '.marital_status_input', function(){
        let marital_status = $(this).val();

        if (marital_status === 'Unmarried') {
            $('.married_section').hide();
            $('.married_section input').removeAttr('required', 'required');
        } else {
            $('.married_section').show();
            $('.married_section input').attr('required', 'required');
        }
    });

    $(document).on('click', '.new_kid_btn', function(){
        let kid_html = '<div class="row">'
                        + '<div class="col-md-6">'
                            + '<div class="form-group">'
                                + '<label><b>Name of Kid*</b></label>'

                                + '<div class="input-group">'
                                    + '<div class="input-group-prepend">'
                                        + '<button type="button" class="btn btn-danger remove_kid_field"><i class="fas fa-trash"></i></button>'
                                    + '</div>'

                                    + '<input type="text" class="form-control fix-rounded-right" name="kid_name[]" placeholder="Name of Kid" required>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="col-md-6">'
                            + '<div class="form-group">'
                                + '<label><b>Date of Birth*</b></label>'

                                + '<input type="date" class="form-control" name="kid_dob[]" required>'
                            + '</div>'
                        + '</div>'
                    + '</div>';

        $('.kids_inputs').append(kid_html);
    });

    $(document).on('click', '.remove_kid_field', function(){
        $(this).closest('.row').remove();
    });
</script>
@endsection
