@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Notice - ' . ($settings_g['title'] ?? env('APP_NAME'))
    ])
@endsection

@section('master')
@php
    $notices = App\Models\Notice::where('status',1)->orderBy('id','DESC')->paginate(6);
@endphp
<div class="page_wrap">
    <div class="container">
        <div class="row">
            @foreach ($notices as $notice)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{$notice->title}}</h4>
                            <small class="mb-4 d-block" style="font-size: 10px">{{date('d/m/Y h:ia', strtotime($notice->created_at))}}</small>

                            <div class="text-justify">
                                {!! $notice->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{$notices->links()}}
    </div>
</div>
@endsection
