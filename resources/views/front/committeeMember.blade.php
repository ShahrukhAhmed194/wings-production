@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => $member->User->full_name . ' - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])

<style>
    .member_image{max-width: 100%; width: 140px}
</style>
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 ">
                        <h5>{{$member->User->full_name}}</h5>
                        <h6>{{$member->designation}}</h6>
                    </div>
                    <div class="col-6 text-right">
                        <img src="{{$member->img_paths['small']}}" alt="{{$member->User->full_name}}" class="img-thumbnail member_image">
                    </div>

                </div>
            </div>

            <div class="card-body">
                {!! $member->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
