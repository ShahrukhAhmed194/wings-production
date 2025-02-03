<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('title') - {{$settings_g['title'] ?? env('APP_NAME')}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{$settings_g['favicon'] ?? ''}}">

  <link rel="stylesheet" href="{{asset('back/css/normalize.css')}}">
  <link rel="stylesheet" href="{{asset('back/css/main.css')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('back/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('back/css/responsive.css')}}">

  <!-- fontawesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

  <meta name="theme-color" content="#fafafa">

  @yield('head')

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  @include('switcher::code')

  <script>
    window.application_root = '{{url("/")}}';
    window.application_root_api = '{{url("/api")}}';
  </script>

  <link href="{{asset('back/css/print.css')}}" media="print" rel="stylesheet">
</head>

<body>
    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Custom Loader -->
    <div class="loader noPrint" style="display: none">
        <i class="fas fa-spinner fa-spin"></i>
    </div>

  <div class="main" id="app">
    <header class="noPrint">
      <div class="container-fluid">
        <div class="header_wrap">
          <div class="row">
            <div class="col-md-6">
              <ul class="npnls left_menu">
                <li><a href="{{route('homepage')}}" target="_blank" class="app_name">{{$settings_g['title'] ?? ''}}</a></li>
<!--                 <li><a href="" class="sidebar_btn"><i class="fas fa-bars"></i></a></li>-->
              </ul>
            </div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-6 d-block d-md-none">
                  <ul class="npnls header_right_items hli">
                    <li><a href="#" onclick="menuTrigger()"><i class="fas fa-bars"></i></a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-12 d-none d-md-block">
                  <ul class="npnls text-right header_right_items">
                     <li><a href=""><i class="fas fa-bell"></i></a></li>
                    <li>
                      <a href="#"><i class="fa fa-user"></i></a>

                      <ul class="npnls header_right_dropdown">
                        <li><a href="{{route('admin.update-profile')}}"><i class="fas fa-user mr-2"></i>Profile</a></li>
                        <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-lock mr-2"></i> Logout</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <aside class="main-sidebar noPrint" id="sidebar_accordion">
      <ul class="npnls">
        <li><a href="{{route('dashboard')}}" class="{{(request()->route()->getName() == 'dashboard') ? 'active' : ''}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>

        <li>
            <a href="" class="{{(Route::is('back.members.create') || Route::is('back.members.index') || Route::is('back.members.edit') || Route::is('back.member.unpaid.edit')) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_members" aria-expanded="false"><i class="fas fa-users"></i> Members <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>
            <ul class="sub_ms collapse {{(Route::is('back.members.create') || Route::is('back.members.edit') || Route::is('back.members.index') || Route::is('back.member.unpaid')) ? 'show' : ''}}" id="collapse_members" data-parent="#sidebar_accordion">
              <li  class="{{Route::is('back.members.create')  ? 'active_sub_menu' : ''}}"><a href="{{route('back.members.create')}}">Add New</a></li>
              <li class="{{((Route::is('back.members.index') && request('status') == 'All') || Route::is('back.members.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.members.index')}}?status=All">All Members</a></li>
            </ul>
        </li>
        <li><a class="{{(Route::is('back.news.index') || Route::is('back.news.create') || Route::is('back.news.edit')) ? 'active' : ''}}" href="{{route('back.news.index')}}"><i class="fas fa-newspaper"></i> News</a></li>

        <li>
            <a href="" class="{{(Route::is('back.galleries.index') || Route::is('back.galleries.edit') ) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_gallery" aria-expanded="false"><i class="fas fa-images"></i> Gallery <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

            <ul class="sub_ms collapse {{(Route::is('back.galleries.index') || Route::is('back.galleries.edit') || Route::is('back.galleries.categoryCreate') || Route::is('back.galleries.category') || Route::is('back.second.gallery.index') || Route::is('back.second.gallery.edit')) ? 'show' : ''}}" id="collapse_gallery" data-parent="#sidebar_accordion">
              <li class="{{(Route::is('back.galleries.index') || Route::is('back.galleries.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.galleries.index')}}">Gallery</a></li>
              <li class="{{(Route::is('back.second.gallery.index') || Route::is('back.second.gallery.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.second.gallery.index')}}">Gallery 2</a></li>
            </ul>
        </li>

        <li class="{{(Route::is('back.committees.index') || Route::is('back.committees.edit')) ? 'active' : ''}}"><a href="{{route('back.committees.index')}}"><i class="fas fa-users"></i> Committee</a></li>
          <li>
          <a href="" class="{{(Route::is('back.pages.index') || Route::is('back.pages.create') || Route::is('back.pages.edit') || Route::is('back.frontend.general') || Route::is('back.menus.index') || Route::is('back.sliders.index') || Route::is('back.media.settings') || Route::is('back.feature-ads.index')) ? 'active' : ''}}" type="button" data-toggle="collapse" data-target="#collapse_frontend" aria-expanded="false"><i class="fas fa-globe-asia"></i> Front End <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

          <ul class="sub_ms collapse {{(Route::is('back.pages.index') || Route::is('back.pages.create') || Route::is('back.pages.edit') || Route::is('back.frontend.general') || Route::is('back.pages.index') || Route::is('back.menus.index') || Route::is('back.sliders.index') || Route::is('back.media.settings') || Route::is('back.feature-ads.index')) ? 'show' : ''}}" id="collapse_frontend" data-parent="#sidebar_accordion">
            <li class="{{(request()->route()->getName() == 'back.frontend.general') ? 'active_sub_menu' : ''}}"><a href="{{route('back.frontend.general')}}">General Settings</a></li>

             <li class="{{(Route::is('back.pages.index') || Route::is('back.pages.create') || Route::is('back.pages.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.pages.index')}}">Pages</a></li>
            <li class="{{(request()->route()->getName() == 'back.menus.index') ? 'active_sub_menu' : ''}}"><a href="{{route('back.menus.index')}}">Menus</a></li>


            <li class="{{(request()->route()->getName() == 'back.sliders.index') ? 'active_sub_menu' : ''}}"><a href="{{route('back.sliders.index')}}">Slider</a></li>
          </ul>
        </li>
          <li>
              <a href="" class="{{(Route::is('back.notification.email') || Route::is('back.notification.emailSend') || Route::is('back.notification.emailShow') || Route::is('back.notification.push') || Route::is('back.notice.index') || Route::is('back.notice.create') || Route::is('back.notice.edit')) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_notification" aria-expanded="false"><i class="fas fa-bell"></i> Notification <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

              <ul class="sub_ms collapse {{(Route::is('back.notification.email') || Route::is('back.notification.emailSend') || Route::is('back.notification.emailShow') ||  Route::is('back.notice.index') || Route::is('back.notice.create') || Route::is('back.notice.edit')) ? 'show' : ''}}" id="collapse_notification" data-parent="#sidebar_accordion">
                  <li  class="{{(Route::is('back.notice.index') || Route::is('back.notice.create') || Route::is('back.notice.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.notice.index')}}">Notice</a></li>
              </ul>
          </li>


        <li class="{{(request()->route()->getName() == 'back.admins.index') ? 'active' : ''}}"><a href="{{route('back.admins.index')}}"><i class="fas fa-user"></i> Admins</a></li>
      </ul>
    </aside>

    <div class="content-wrapper">
      <div class="content">
        <section class="content-header noPrint">
          <div class="row">
            <div class="col-md-6">
              <h1>
                @yield('title')
                <small>{{env('APP_NAME', 'Name')}}</small>
              </h1>
            </div>

            <div class="col-md-6">
              <ul class="npnls text-left text-md-right ch_breadcrumb">
                <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard > </a></li>
                <li class="active">@yield('title')</li>
              </ul>
            </div>
          </div>
        </section>

        <div class="content_body">
            @if(isset($errors))
                @include('extra.error-validation')
            @endif
            @if(session('success'))
                @include('extra.success')
            @endif
            @if(session('error'))
                @include('extra.error')
            @endif

          @yield('master')
        </div>
      </div>

      <footer class="p-3 noPrint">
        <p class="mb-0">Copyright &copy; {{date('Y')}}. All right reserved {{ env('APP_NAME') }}</p>
      </footer>
    </div>
  </div>

  <script src="{{asset('back/js/vendor/modernizr-3.11.2.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="{{asset('back/js/plugins.js')}}"></script>
  <!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.0/dist/sweetalert2.all.min.js"></script>

  <script src="{{asset('back/js/main.js')}}"></script>

    @if(session('success-alert'))
        <script>
            cAlert('success', "{{session('success-alert')}}");
        </script>
    @endif

    @if(session('error-alert'))
        <script>
            cAlert('error', "{{session('error-alert')}}");
        </script>
    @endif

    @yield('footer')
</body>

</html>
