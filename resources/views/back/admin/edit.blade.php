@extends('back.layouts.master')
@section('title', 'Edit Admin')

{{-- @section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection --}}

@section('master')
<form action="{{route('back.admins.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-md-8">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Name*</b></label>
                                <input type="text" class="form-control form-control-sm" name="last_name" value="{{old('last_name') ?? $user->full_name}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Email*</b></label>
                                <input type="email" class="form-control form-control-sm" name="email" value="{{old('email') ?? $user->email}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Mobile Number*</b></label>
                                <input type="number" class="form-control form-control-sm" name="mobile_number" value="{{old('mobile_number') ?? $user->mobile_number}}" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label><b>Address*</b></label>
                                <textarea class="form-control form-control-sm" name="address" required>{{old('street') ?? $user->address}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    @if($user->profile_image)
                                    <img class="img-thumbnail uploaded_img" src="{{$user->profile_path}}">
                                    @else
                                    <img class="img-thumbnail uploaded_img" src="{{asset('img/default-img.png')}}">
                                    @endif

                                    <div class="form-group text-center">
                                        <label><b>Profile Picture</b></label>
                                        <div class="custom-file text-left">
                                            <input type="file" class="custom-file-input image_upload" name="profile_image" accept="image/*">
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Password*</b></label>
                                <input type="password" class="form-control form-control-sm" name="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Confirm Password*</b></label>
                                <input type="password" class="form-control form-control-sm" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success btn-block">Update</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- <div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Edit Admin</h5>

        <a href="{{route('back.admins.index')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-list"></i> Admin list</a>
    </div>
    <form action="{{route('back.admins.update', $user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Name*</b></label>
                        <input type="text" class="form-control" name="name" value="{{old('name') ?? $user->full_name}}" required>
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
                        <label><b>Mobile Number*</b></label>
                        <input type="number" class="form-control" name="mobile_number" value="{{old('mobile_number') ?? $user->mobile_number}}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Street*</b></label>
                        <input type="text" class="form-control" name="street" value="{{old('street') ?? $user->street}}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Zip*</b></label>
                        <input type="text" class="form-control" name="zip" value="{{old('zip') ?? $user->zip}}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>City*</b></label>
                        <input type="text" class="form-control" name="city" value="{{old('city') ?? $user->city}}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>State*</b></label>
                        <input type="text" class="form-control" name="state" value="{{old('state') ?? $user->state}}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Country*</b></label>
                        <input type="text" class="form-control" name="country" value="{{old('country') ?? $user->country}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Profile Picture</b></label>
                        <input type="file" class="form-control" name="profile" accept="image/*">
                    </div>
                    @if($user->profile)
                    <img src="{{$user->profile_path}}" style="width: 120px" >
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Password</b></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Confirm Password</b></label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </form>
</div> --}}
@endsection

{{-- @section('footer')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#dataTable').DataTable();
    });
</script>
@endsection --}}
