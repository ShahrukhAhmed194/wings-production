@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Login - ' . ($settings_g['title'] ?? ''),
    ])
    <style>
        .auth_card a {
            color: black;
        }
    </style>
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                <form action="{{route('login')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Email or Mobile</label>
                        <input type="text" class="form-control" placeholder="Email or Mobile" value="{{old('email')}}" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button class="button button_md">Login</button>
                        </div>

                        <div class="col-8 text-right">
                            <a href="{{route('password.request')}}">Forgot Password?</a>
                        </div>

                        <div class="col-12">
                            <p class="mt-4">Do not have any account? <a href="{{route('register')}}">Register now.</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
