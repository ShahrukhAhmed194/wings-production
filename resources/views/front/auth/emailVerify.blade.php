@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Email verify - ' . ($settings_g['title'] ?? ''),
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="">
                    <div class="card shadow my-5 auth_card">
                        <div class="card-header text-center"><h4>Email verify</h4></div>

                        <div class="card-body">
                            <p>Thanks for your registration. Please check your mail({{$user->email}}) to verify your account.</p>

                            <a href="{{route('resendVerifyLink', $user->id)}}" style="color: #fff" class="button button_md">Resend verification link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
