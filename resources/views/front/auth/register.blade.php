@extends('front.layouts.master')
@php
    $types = \App\Models\MemberType::where(['is_active'=>1])->orderBy('position','asc')->get();
    $is_active = env('REGISTRATION_ACTIVE');
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Register - ' . ($settings_g['title'] ?? ''),
    ])
@endsection

@section('master')
    @if($is_active)
        <div class="page_wrap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-6">
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <h4 class="text-center">Membership Registration</h4>
                            <div class="form-group">
                                <label>Membership Type*</label>
                                <select name="member_type_id" class="form-control @error('member_type_id') is-invalid @enderror" required>
                                    <option value="">Select One</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id  }}">{{ $type->name }} ৳{{$type->amount}}</option>
                                    @endforeach
                                </select>
                                @error('member_type_id')
                                <span class="invalid-feedback" role="alert">
                                <strong class="text-light">{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Full Name*</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" value="{{old('name')}}" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong class="text-light">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email Address*</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong class="text-light">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password*</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong class="text-light">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password*</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button class="button button_md">Register</button>
                                </div>

                                <div class="col-md-8 text-right">
                                    <button hidden class="button button_md"></button>
                                </div>

                                <div class="col-md-12">
                                    <p class="mt-4">Already have account? <a href="{{route('login')}}">Login now</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('front.layouts.registrationExpire')
    @endif
@endsection
