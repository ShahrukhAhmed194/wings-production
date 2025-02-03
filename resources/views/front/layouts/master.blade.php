<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
    $main_menu = App\Models\Menu::with('SingleMenuItems')->where('name', 'Main Menu')->active()->first();
    $footer_menu = App\Models\Menu::with('SingleMenuItems')->whereLike('name', 'Footer Menu%')->active()->get();
    $notices = App\Models\Notice::where('status',1)->orderBy('id','DESC')->take(5)->get();
    $socials = cache()->remember('homepage_social', (60 * 60 * 24 * 90), function(){
        return Info::SettingsGroup('social');
    });
@endphp

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Icons -->
  <link rel="shortcut icon" href="{{$settings_g['favicon'] ?? ''}}">

  <link rel="stylesheet" href="{{asset('front/css/normalize.css')}}">
  <link rel="stylesheet" href="{{asset('front/css/main.css')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
  <link rel="stylesheet" href="{{asset('front/mobile-menu/docs/demo.css')}}">

  {{-- Google Font --}}
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

  <!-- fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

    <meta name="theme-color" content="#fafafa">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="{{asset('front/mobile-menu/dist/hc-offcanvas-nav.js')}}"></script>
  @yield('head')
</head>

<body class="theme-default">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=2526973427525730&autoLogAppEvents=1" nonce="CKIlnvpq"></script>

    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
        @csrf
    </form>

    <header>
        <div class="main_header pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-2">
                        <div class="logo">
                            <a href="{{route('homepage')}}">
                                <img src="{{$settings_g['logo'] ?? ''}}" alt="{{$settings_g['title'] ?? env('APP_NAME')}}">
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 d-block d-lg-none text-right">
                        <button class="toggle mobile_menu_toggle"><i class="fas fa-bars"></i></button>
                    </div>

                    <div class="col-md-10 d-none d-md-none d-lg-block">
                        <div class="main_menu text-right d-none d-lg-block" id="main-nav">
                            @if($main_menu)
                            <ul class="npnls">
                                <li>
                                    <a href="{{route('homepage')}}">Home</a>
                                </li>
                                @foreach ($main_menu->SingleMenuItems as $item)
                                    <li>
                                        <a href="{{$item->menu_info['url']}}">{{$item->menu_info['text']}} @if(count($item->Items)) <i class="fas fa-chevron-down d-none d-lg-inline-block"></i> @endif </a>

                                        @if(count($item->Items))
                                        <ul>
                                            @foreach ($item->Items as $sub_menu)
                                            <li><a href="{{$sub_menu->menu_info['url']}}">{{$sub_menu->menu_info['text']}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                                @guest
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Membership</a></li>
                                @else
                                    <li>
                                        @if(auth()->check() && auth()->user()->type=='admin')
                                            <a href="{{route('dashboard')}}">Dashboard</a>
                                        @else
                                            <a href="{{route('userDashboard')}}">Dashboard</a>
                                        @endif

                                    </li>
                                    <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}">Logout</a></li>
                                @endguest

                                {{--@guest
                                <li class="d-block d-md-none"><a href="{{route('login')}}">Login</a></li>
                                <li class="d-block d-md-none"><a href="{{route('register')}}">Register</a></li>
                                @else
                                <li class="d-block d-md-none"><a href="{{route('userDashboard')}}">Dashboard</a></li>
                                <li class="d-block d-md-none"><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('register')}}">Logout</a></li>
                                @endguest--}}
                            </ul>
                            @else
                            <p class="mt-1 mb-0 py-2">Have no any main menu</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ticker">
            <div class="notice_title"><h5>Notices</h5></div>
            <div class="news">
                <marquee class="news-content">
                    @foreach($notices as $notice)
                        <p><a style="color:white;" href="/notice">{{ $notice->title }}</a></p>
                    @endforeach
                </marquee>
            </div>
        </div>
    </header>

    @yield('master')

    <footer>
        <div class="widget_footer">
            <div class="container">
                @if($footer_menu)
                    <div class="row">
                        @foreach ($footer_menu as $item)
                            <div class="col-md-3">
                                <div class="f_widget_box mb-5">
                                    {{--<h2>{{$item->menu_info['text']}}</h2>--}}

                                    <div class="f_widget_content">
                                        <ul class="npnls">
                                            @foreach ($item->SingleMenuItems as $item)
                                                <li><a href="{{$item->menu_info['url']}}" target="_blank">{{$item->menu_info['text']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Please create "Footer Menu"</p>
                @endif
            </div>
        </div>
        <hr class="mt-0 mb-0">
        <div class="flex flex-wrap justify-center gap-2">
            @foreach ($socials as $social)
                @if($social->name == 'facebook')
                    <a href="{{$social->value}}" class="bg-blue-500 p-2 font-semibold text-white inline-flex items-center space-x-2 rounded-full">
                        <svg class="w-5 h-5 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" /></svg>
                    </a>
                @elseif($social->name == 'twitter')
                    <a href="{{$social->value}}" class="bg-blue-400 p-2 font-semibold text-white inline-flex items-center space-x-2 rounded-full">
                        <svg class="w-5 h-5 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" /></svg>
                    </a>
                @elseif($social->name == 'instagram')
                    <a href="{{$social->value}}" class="bg-pink-500 p-2 font-semibold text-white inline-flex items-center space-x-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5 fill-current"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    </a>
                @elseif($social->name == 'linkedin')
                    <a href="{{$social->value}}" class="bg-blue-600 p-2 font-semibold text-white inline-flex items-center space-x-2 rounded-full">
                        <svg class="w-5 h-5 fill-current" role="img" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <g><path d="M218.123122,218.127392 L180.191928,218.127392 L180.191928,158.724263 C180.191928,144.559023 179.939053,126.323993 160.463756,126.323993 C140.707926,126.323993 137.685284,141.757585 137.685284,157.692986 L137.685284,218.123441 L99.7540894,218.123441 L99.7540894,95.9665207 L136.168036,95.9665207 L136.168036,112.660562 L136.677736,112.660562 C144.102746,99.9650027 157.908637,92.3824528 172.605689,92.9280076 C211.050535,92.9280076 218.138927,118.216023 218.138927,151.114151 L218.123122,218.127392 Z M56.9550587,79.2685282 C44.7981969,79.2707099 34.9413443,69.4171797 34.9391618,57.260052 C34.93698,45.1029244 44.7902948,35.2458562 56.9471566,35.2436736 C69.1040185,35.2414916 78.9608713,45.0950217 78.963054,57.2521493 C78.9641017,63.090208 76.6459976,68.6895714 72.5186979,72.8184433 C68.3913982,76.9473153 62.7929898,79.26748 56.9550587,79.2685282 M75.9206558,218.127392 L37.94995,218.127392 L37.94995,95.9665207 L75.9206558,95.9665207 L75.9206558,218.127392 Z M237.033403,0.0182577091 L18.8895249,0.0182577091 C8.57959469,-0.0980923971 0.124827038,8.16056231 -0.001,18.4706066 L-0.001,237.524091 C0.120519052,247.839103 8.57460631,256.105934 18.8895249,255.9977 L237.033403,255.9977 C247.368728,256.125818 255.855922,247.859464 255.999,237.524091 L255.999,18.4548016 C255.851624,8.12438979 247.363742,-0.133792868 237.033403,0.000790807055"></path></g>
                        </svg>
                    </a>
                @elseif($social->name == 'youtube')
                    <a href="{{$social->value}}" class="bg-red-600 p-2 font-semibold text-white inline-flex items-center space-x-2 rounded-full">
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" /></svg>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="copyright">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="mt-2">{!! $settings_g['copyright'] ?? '' !!}</div>
                <div><span>Developed by <a class="text-white" href="https://eomsbd.com">Best E-commerce Website Developer</a></span></div>
            </div>
        </div>
    </footer>

    <script src="{{asset('front/js/vendor/modernizr-3.11.2.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{asset('front/js/plugins.js')}}"></script>

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.0/dist/sweetalert2.all.min.js"></script>

    <script src="{{asset('front/js/main.js')}}"></script>

    @if(session('success-alert'))
        <script>
            cAlert('success', "{{session('success-alert')}}");
        </script>
    @endif

    @if(session('success-alert2'))
        <script>
            Swal.fire(
                'Success!',
                '{{session("success-alert2")}}',
                'success'
            );
        </script>
    @endif

    @if(session('error-alert'))
        <script>
            cAlert('error', "{{session('error-alert')}}");
        </script>
    @endif

    @if(session('error-alert2'))
        <script>
            Swal.fire(
                'Faild!',
                '{{session("error-alert2")}}',
                'error'
            );
        </script>
    @endif

    <script>
        (function($) {
            'use strict';

            // call our plugin
            var Nav = new hcOffcanvasNav('#main-nav', {
                disableAt: false,
                customToggle: '.toggle',
                levelSpacing: 40,
                navTitle: '',
                levelTitles: true,
                levelTitleAsBack: true,
                pushContent: '#container',
                labelClose: false
            });
        })(jQuery);
    </script>

    @yield('footer')
</body>

</html>
