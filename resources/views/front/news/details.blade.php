@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => $news->title . ' - ' . ($settings_g['title'] ?? env('APP_NAME')),
        'image' => $news->media_id ? $news->img_paths['medium'] : null,
        'description' => $news->meta_description
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h5 class="page_title mb-0">{{$news->title}}</h5>
                    </div>

                    <div class="card-body">
                        @if($news->media_id)
                        <div class="d-block">
                            <img src="{{$news->img_paths['original']}}" class="rounded mx-auto d-block img-fluid img-thumbnail" alt="{{$news->title}}">
                        </div>
                        @endif

                        <div class="text-justify mt-3">
                            {!! $news->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Recent News</h5>
                    </div>
                    <div class="card-body">
                        <div class="user_menu mt-4">
                            <ul class="list-group up_nav">
                                @foreach ($recent_news as $recent_news_item)
                                    <li class="list-group-item"><a href="{{$recent_news_item->route}}"><i class="fa fa-circle"></i> {{$recent_news_item->title}}</a></li>
                                @endforeach
                                <li class="list-group-item text-center"><a href="{{url('news')}}">View All <i class="fa fa-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

<script type="application/ld+json">
    {
    "@context":"https://schema.org",
    "@type":"BreadcrumbList",
    "itemListElement":[
        {
            "item":{
                "name":"Home",
                "@id":"{{url('/')}}"
            },
            "@type":"ListItem",
            "position":"1"
        },
        {
            "item":{
                "name":"{{$news->title}}",
                "@id":"{{$news->route}}"
            },
            "@type":"ListItem",
            "position":"2"
        }
    ]
    }
</script>

@if($news->media_id && $news->meta_description && $news->description)
<script type="application/ld+json">
    {
    "@context": "http://schema.org/",
    "@type": "Article",
    "author": "EOMSBD",
    "publisher": {
        "name":"{{$settings_g['title']}}",
        "@type": "Organization",
        "url": "{{route('homepage')}}",
        "sameAs": [
            "https://www.facebook.com"
        ],
        "logo": {
        "@type": "ImageObject",
        "url": "{{$settings_g['logo']}}"
        },
        "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "{{$settings_g['mobile_number']}}",
            "contactType": "customer service"
        }]
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{route('homepage')}}"
    },
    "headline": "{{$news->title}}",
    "name": "{{$news->meta_description}}",
    "image": "{{$news->img_paths['medium']}}",
    "description": "{!!preg_replace("/\r|\n/", " ", $news->description)!!}",
    "datePublished": "{{$news->created_at}}",
    "dateModified": "{{$news->updated_at}}"
    }
    </script>
@endif

@endsection
