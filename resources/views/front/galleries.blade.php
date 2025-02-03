@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Gallery - ' . ($settings_g['title'] ?? env('APP_NAME'))
    ])
@endsection

@section('master')
@php
    $galleries = App\Models\Gallery::where('status',1)->orderBy('id','DESC')->paginate(6);
@endphp
<div class="page_wrap">
    <div class="container">
        <section class="news_section">
            <div class="row">
                @foreach ($galleries as $gallery)
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="{{$gallery->img_path}}" class="whp" alt="{{$gallery->name}}">

                            <div class="card-body">
                            <h6 class="card-title">{{$gallery->name}}</h6>
                            <a href="{{route('gallery', $gallery->id)}}" class="button button_md">View Photos</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{$galleries->links()}}
    </div>
</div>
@endsection
