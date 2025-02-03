@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => $gallery->name . ' - ' . ($settings_g['title'] ?? env('APP_NAME'))
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <h4 class="mb-0 text-center mb-3">{{$gallery->name}}</h4>
        <div class="row">
            @foreach ($gallery->GalleryItems as $photo)
                <div class="col-md-6 col-lg-4">
                    <a data-fslightbox href="{{$photo->img_paths['original']}}" class="d-block mb-3" style="border-radius: 4px;overflow: hidden;">
                        <img src="{{$photo->img_paths['small']}}" alt="{{$gallery->gallery_name}}" class="whp">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="{{asset('front/js/fslightbox/fslightbox.js')}}"></script>
@endsection
