@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => $page->title . ' - ' . ($settings_g['title'] ?? env('APP_NAME')),
        'image' => $page->media_id ? $page->img_paths['medium'] : null,
        'description' => $page->meta_description
    ])
@endsection

@section('master')
<div class="page_wrap pages_page_wrap">
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="page_title mb-0">{{$page->title}}</h5>
            </div>

            <div class="card-body">
                @if($page->media_id)
                <div class="d-block">
                    <img src="{{$page->img_paths['large']}}" class="page_img" alt="{{$page->title}}">
                </div>
                @endif

                <div class="text-justify mt-3 page_description_wrap">
                    {!! $page->description !!}
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
                "name":"{{$page->title}}",
                "@id":"{{$page->route}}"
            },
            "@type":"ListItem",
            "position":"2"
        }
    ]
    }
</script>

@if($page->media_id && $page->description)
<script type="application/ld+json">
    {
    "@context": "http://schema.org/",
    "@type": "Article",
    "author": "AAMS",
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
    "headline": "{{$page->title}}",
    "name": "{{$page->title}}",
    "image": "{{$page->img_paths['medium']}}",
    "description": "{!!preg_replace("/\r|\n/", " ", $page->description)!!}",
    "datePublished": "{{$page->created_at}}",
    "dateModified": "{{$page->updated_at}}"
    }
    </script>
@endif

@endsection
