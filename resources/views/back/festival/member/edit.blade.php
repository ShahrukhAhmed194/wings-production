@extends('back.layouts.master')
@section('title', 'Festival Member Registration')
@section('head')

@endsection

@section('master')
<div class="page_wrap">
    <div class="container-md">
        @if(isset($errors))
            @include('extra.error-validation')
        @endif
        @if(session('success'))
            @include('extra.success')
        @endif
        @if(session('error'))
            @include('extra.error')
        @endif

        <form action="{{ route('back.festival.member.update',$festivalMember->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card border-light shadow">
                <div class="card-header">
                    <a href="{{route('back.festival.member',$festival->id)}}" class="btn btn-success btn-sm float-left"> << Back</a>
                    <h6 class="d-inline-block mb-0 ml-3">Member Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="img_groupp uploaded_member_img_group">
                                <div class="text-center">
                                    <img class="img-thumbnail uploaded_img uploaded_member_img"
                                         src="{{ $festivalMember->image ? asset($festivalMember->image) : asset('img/user-img.jpg')}}">
                                </div>

                                <div class="form-group mt-2">
                                    <div class="custom-file text-left">
                                        <input type="file" class="custom-file-input image_upload" accept="image/*"
                                               name="image" >
                                        <label class="custom-file-label"><b>Upload Photo</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Full Name*</b></label>
                                <input type="text" class="form-control" name="name" placeholder="full name" value="{{$festivalMember->name??old('name')}}" required>
                            </div>
                        </div>
                        {{--
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Nick Name *</b></label>

                                <input type="text" class="form-control" placeholder="nike name" name="nick_name" value="{{$festivalMember->nick_name??old('nick_name')}}" required>
                            </div>
                        </div>
                        --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Father Name </b></label>

                                <input type="text" class="form-control" placeholder="father name" name="father_name" value="{{$festivalMember->father_name??old('father_name')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Mother Name </b></label>

                                <input type="text" class="form-control" placeholder="mother name" name="mother_name" value="{{$festivalMember->mother_name??old('mother_name')}}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Email*</b></label>

                                <input type="email" class="form-control" name="email" placeholder="email" value="{{$festivalMember->email??old('email')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Mobile Number*</b></label>

                                <input type="number" class="form-control" placeholder="mobile number" name="phone_number" value="{{$festivalMember->phone_number??old('phone_number')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Session*</b></label>
                                <input type="text" class="form-control" placeholder="session" name="session" value="{{$festivalMember->session??old('session')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Gender*</b></label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option {{ $festivalMember->gender=='Male'?'selected':'' }} value="Male">Male</option>
                                    <option {{ $festivalMember->gender=='Female'?'selected':'' }} value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Blood Group</b></label>

                                <select name="blood_group" class="form-control" >
                                    <option value="">Select Blood Group</option>
                                    @foreach ($blood_groups as $group)
                                        <option {{ $festivalMember->blood_group==$group?'selected':'' }} value="{{$group}}">{{$group}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>T-Shirt Size*</b></label>

                                <select name="t_shirt" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($t_shirts as $size)
                                        <option {{ $festivalMember->t_shirt==$size?'selected':'' }} value="{{$size}}">{{$size}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Number of Person *</b></label>
                                <input type="number" class="form-control" placeholder="number of person" min="1" max="10" name="number_of_person" value="{{$festivalMember->number_of_person}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Number of Guest *</b></label>
                                <input type="number" class="form-control" placeholder="number of guest" min="0" max="10" name="number_of_guest" value="{{$festivalMember->number_of_guest}}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Total Amount *</b></label>
                                <input type="number" class="form-control" placeholder="payable_amount" step="any" value="{{$festivalMember->payable_amount}}" name="payable_amount" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Address</b></label>

                                <input type="text" class="form-control" placeholder="Address" name="address" value="{{$festivalMember->address??old('address')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Payment Status *</b></label>
                                <select name="is_paid" class="form-control" required>
                                    <option value="1">Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Payment Type *</b></label>
                                <input type="text" class="form-control" placeholder="Bkash/Rocket/Manual" name="payment_type" value="{{$festivalMember->payment_type??old('payment_type')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Transaction No *</b></label>
                                <input type="text" class="form-control" placeholder="AB karim/ss1000" name="transaction_no" value="{{$festivalMember->transaction_no??old('transaction_no')}}" required>
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

                                <input type="text" class="form-control" placeholder="Organization/Company" name="organization_name" value="{{$festivalMember->organization_name??old('organization_name')}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Designation</b></label>

                                <input type="text" class="form-control" placeholder="Designation" name="designation" value="{{$festivalMember->designation??old('designation')}}" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Phone No</b></label>

                                <input type="number" class="form-control" placeholder="Phone No" name="organization_phone" value="{{$festivalMember->organization_phone??old('organization_phone')}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Organization/Company Address</b></label>

                                <input type="text" class="form-control" placeholder="Organization/Company Address" name="organization_address" value="{{$festivalMember->organization_address??old('organization_address')}}">
                            </div>
                        </div>
                    </div>

                    <button class="button button_md mt-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer')

@endsection
