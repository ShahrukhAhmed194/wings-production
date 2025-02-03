@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => ($settings_g['title'] ?? env('APP_NAME')) . ' -> ' . ($settings_g['slogan'] ?? 'Home')
    ])

    <link rel="stylesheet" href="{{asset('front/css/camera.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/flipclock.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">

    <!-- LOADING FONTS AND ICONS -->
    <link href="https://fonts.googleapis.com/css?family=Saira:400%7CRoboto:500%2C400" rel="stylesheet" property="stylesheet" media="all" type="text/css" >
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/rs/css/rs6.css')}}">
    <!-- REVOLUTION LAYERS STYLES -->

    <!-- REVOLUTION JS FILES -->
    <script type="text/javascript" src="{{asset('front/rs/js/rbtools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/rs/js/rs6.min.js')}}"></script>

    <script type="text/javascript">function setREVStartSize(e){
            //window.requestAnimationFrame(function() {
            window.RSIW = window.RSIW===undefined ? window.innerWidth : window.RSIW;
            window.RSIH = window.RSIH===undefined ? window.innerHeight : window.RSIH;
            try {
                var pw = document.getElementById(e.c).parentNode.offsetWidth,
                    newh;
                pw = pw===0 || isNaN(pw) ? window.RSIW : pw;
                e.tabw = e.tabw===undefined ? 0 : parseInt(e.tabw);
                e.thumbw = e.thumbw===undefined ? 0 : parseInt(e.thumbw);
                e.tabh = e.tabh===undefined ? 0 : parseInt(e.tabh);
                e.thumbh = e.thumbh===undefined ? 0 : parseInt(e.thumbh);
                e.tabhide = e.tabhide===undefined ? 0 : parseInt(e.tabhide);
                e.thumbhide = e.thumbhide===undefined ? 0 : parseInt(e.thumbhide);
                e.mh = e.mh===undefined || e.mh=="" || e.mh==="auto" ? 0 : parseInt(e.mh,0);
                if(e.layout==="fullscreen" || e.l==="fullscreen")
                    newh = Math.max(e.mh,window.RSIH);
                else{
                    e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                    for (var i in e.rl) if (e.gw[i]===undefined || e.gw[i]===0) e.gw[i] = e.gw[i-1];
                    e.gh = e.el===undefined || e.el==="" || (Array.isArray(e.el) && e.el.length==0)? e.gh : e.el;
                    e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                    for (var i in e.rl) if (e.gh[i]===undefined || e.gh[i]===0) e.gh[i] = e.gh[i-1];

                    var nl = new Array(e.rl.length),
                        ix = 0,
                        sl;
                    e.tabw = e.tabhide>=pw ? 0 : e.tabw;
                    e.thumbw = e.thumbhide>=pw ? 0 : e.thumbw;
                    e.tabh = e.tabhide>=pw ? 0 : e.tabh;
                    e.thumbh = e.thumbhide>=pw ? 0 : e.thumbh;
                    for (var i in e.rl) nl[i] = e.rl[i]<window.RSIW ? 0 : e.rl[i];
                    sl = nl[0];
                    for (var i in nl) if (sl>nl[i] && nl[i]>0) { sl = nl[i]; ix=i;}
                    var m = pw>(e.gw[ix]+e.tabw+e.thumbw) ? 1 : (pw-(e.tabw+e.thumbw)) / (e.gw[ix]);
                    newh =  (e.gh[ix] * m) + (e.tabh + e.thumbh);
                }
                if(window.rs_init_css===undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));
                document.getElementById(e.c).height = newh+"px";
                window.rs_init_css.innerHTML += "#"+e.c+"_wrapper { height: "+newh+"px }";
            } catch(e){
                console.log("Failure at Presize of Slider:" + e)
            }
            //});
        };
    </script>
    <style>
       /* @media only screen and (min-width: 800px) {
            .slider_mobile{
                height: 750px !important;
            }
        }
        @media only screen and (max-width: 800px) {
            .slider_mobile{
                height: 350px !important;
            }
            section.intro {
                margin-top: 10px;
            }
        }*/
       .blink_me {
           animation: blinker 1s linear infinite;
       }

       @keyframes blinker {
           50% { opacity: 0; }
       }
    </style>
@endsection

@section('master')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($sliders as $key=>$slider)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner slider_mobile">
            @foreach ($sliders as $key=>$slider)
            <div class="carousel-item {{$key==0?'active':''}}">
                <img class="w-100 slider_mobile" src="{{$slider->img_paths['original']}}" alt="First slide">
                <div class="carousel-caption">
                    <h5>{{$slider->text_1}}</h5>
                    <h3>{{$slider->description}}</h3>
                    @if($slider->button_1_text && $slider->button_1_url)
                        <a class="button button_md" href="{{$slider->button_1_url}}">{{$slider->button_1_text}}</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    @if(count($news))
        <section class="news_section">
            <div class="container">
                <div class="text-center">
                    <h3 class="section_title mb-4">NEWS <b>{{ env('APP_NAME') }}</b></h3>
                </div>

                <div class="row justify-content-center">
                    @foreach ($news as $news_item)
                        <div class="col-md-6 col-lg-3">
                            <div class="card mb-4">
                                <img class="card-img-top whp" src="{{$news_item->img_paths['medium']}}" alt="{{$news_item->title}}">

                                <div class="card-body">
                                    <h6 class="card-title">{{$news_item->title}}</h6>
                                    <a href="{{$news_item->route}}" class="button button_md">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-2 mb-2">
                    <a href="{{url('news')}}" class="button button_md">Show All</a>
                </div>
            </div>
        </section>
    @endif
    @if(count($galleries))
        <section class="news_section">
            <div class="container">
                <div class="text-center">
                    <h3 class="section_title mb-4">GALLERY <b>{{ env('APP_NAME') }}</b></h3>
                </div>

                <div class="row justify-content-center">
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

                <div class="text-center mt-2 mb-2">
                    <a href="{{url('/gallery')}}" class="button button_md">Show All</a>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('footer')
<script src="{{asset('front/js/flipclock.min.js')}}"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('front/js/camera.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
<script src="{{asset('front/js/jquery.rcounterup.js')}}"></script>
<script src="{{asset('front/js/fslightbox/fslightbox.js')}}"></script>
<script src="{{asset('front/js/mixitup.min.js')}}"></script>

<script>
    $(function(){
        $('.count-num').rCounter({
            duration: 50
        });
    });
</script>

<script>
    var containerEl = document.querySelector('.gallery_items');

    var mixer = mixitup(containerEl);
</script>
@foreach ($events as $event)
    <script>
        $(document).ready(function() {
            // Instantiate a coutdown FlipClock
            clock = $('.clock_id_{{$event->id}}').FlipClock('{{strtotime($event->festival_date) > time() ? strtotime($event->festival_date) - time() : 0}}', {
                clockFace: 'DailyCounter',
                countdown: true
            });
        });
    </script>
@endforeach

<script>
    $(document).ready(function(){
        $(".event_carousel").owlCarousel({
            loop: true,
            margin: 10,
            autoplay: false,
            autoplayHoverPause: true,
            responsiveClass: true,
            nav: false,
            slideBy: 1,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    nav: false
                },
                1200: {
                    items: 1,
                    nav: false,
                }
            }
        });
    });

</script>

@endsection
