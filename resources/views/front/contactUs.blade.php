@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Contact Us - ' . ($settings_g['title'] ?? env('APP_NAME'))
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt-4">
                @if(isset($errors))
                    @include('extra.error-validation')
                @endif

                @if(session('success'))
                    @include('extra.success')
                @endif

                @if(session('error'))
                    @include('extra.error')
                @endif

                <form method="POST" action="{{route('contactUs')}}">
                    @csrf

                    <div class="form-group">
                        <label>Full Name*</label>
                        <input type="text" class="form-control form-control-sm" name="full_name" value="{{old('full_name')}}" required placeholder="Full Name">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email Address*</label>
                                <input type="email" class="form-control form-control-sm" name="email" value="{{old('email')}}" required placeholder="Email Address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" class="form-control form-control-sm" name="mobile_number" value="{{old('mobile_number')}}" placeholder="Mobile Number">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Your Message*</label>

                        <textarea name="message" required class="form-control form-control-sm" cols="30" rows="5" placeholder="Your Message">{{old('message')}}</textarea>
                    </div>
                    <div class="col-sm-6">
                        @captcha
                        <input type="text" required class="form-control form-control-sm"  id="captcha" name="captcha">
                    </div>

                    <button type="submit" class="button button_md mt-3">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="contact_widget mt-4">
                    <div class="row">
                        <div class="col-4 text-right">
                            <div class="cw_icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>

                        <div class="col-8">
                            <p class="mb-0 mt-1">{{$settings_g['street'] ?? ''}}</p>
                            <p>{{$settings_g['city'] ?? ''}}-{{$settings_g['zip'] ?? ''}}, {{$settings_g['state'] ?? ''}}, {{$settings_g['country'] ?? ''}}</p>
                        </div>
                    </div>
                </div>

                <div class="contact_widget mt-4">
                    <div class="row">
                        <div class="col-4 text-right">
                            <div class="cw_icon">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                        <div class="col-8">
                            <p class="mb-0 mt-1">{{$settings_g['mobile_number'] ?? ''}}</p>
                            <p>{{$settings_g['tel'] ? $settings_g['tel'] : ''}}</p>
                        </div>
                    </div>
                </div>

                <div class="contact_widget mt-4 mb-5">
                    <div class="row">
                        <div class="col-4 text-right">
                            <div class="cw_icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <div class="col-8">
                            <p class="mt-3">{{$settings_g['email'] ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
