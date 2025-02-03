@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'News - ' . ($settings_g['title'] ?? env('APP_NAME'))
    ])
@endsection

@section('master')
@php
    $news = App\Models\News::active()->paginate(6);
@endphp
<div class="page_wrap">
    <div class="container">
        <section class="news_section">
            <div class="row">
                @foreach ($news as $news_item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="{{$news_item->img_paths['medium']}}" class="whp" alt="{{$news_item->title}}">

                            <div class="card-body">
                            <h6 class="card-title">{{$news_item->title}}</h6>
                            <a href="{{route('newsDetails', $news_item->id)}}" class="button button_md">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{$news->links()}}
    </div>
</div>
@endsection
