@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Change Password - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="up_wrap">
            <div class="row">
                @include('front.layouts.auth-sidebar')

                <div class="col-md-6 col-lg-9">
                    <div class="up_content_wrap">
                        <form action="{{route('user.changePassword')}}" method="POST">
                            @csrf

                            <div class="card shadow mb-4">
                                <div class="card-header primary_header">
                                    <h4 class="d-inline-block">Change Passowrd</h4>
                                </div>

                                <div class="card-body">
                                    @if(isset($errors))
                                        @include('extra.error-validation')
                                    @endif
                                    @if(session('success'))
                                        @include('extra.success')
                                    @endif
                                    @if(session('error'))
                                        @include('extra.error')
                                    @endif

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>Current Password*</b></label>

                                                <input type="password" class="form-control" placeholder="current password" name="current_password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>New Password*</b></label>

                                                <input type="password" class="form-control" placeholder="new password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>Confirm Password*</b></label>

                                                <input type="password" class="form-control" placeholder="confirm password" name="password_confirmation" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-success">Change</button>
                                    <br>
                                    <small><b>NB: *</b> marked are required field.</small>
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
