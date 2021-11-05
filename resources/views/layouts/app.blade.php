<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tradinos') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/css/base.css')}}" rel="stylesheet">

    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
</head>
<link href="{{asset('/css/fontawsome/fontawsome.min.css')}}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{asset('/js/template/vendors/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/bootstrap.min.js')}}"></script>
{{--    <script type="text/javascript" src="{{trust_asset('/js/vendors/bootstrap.bundle.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/js/template/vendors/perfect-scrollable.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/scrollbar.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/metismenu.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/blockui.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/charts/apex-charts.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/picker.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/picker.date.js')}}"></script>
{{--    <script type="text/javascript" src="{{trust_asset('/js/scripts-init/charts/chartjs.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/js/template/scripts-init/charts/chart.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/charts/chart.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('/js/template/vendors/form-components/select2.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/js/template/vendors/form-components/form-wizard.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/form-components/bootstrap-editable.js')}}"></script>

<script type="text/javascript"
        src="{{asset('/js/template/vendors/form-components/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript"
        src="{{asset('/js/template/vendors/jquery-contextmenu/jquery-contextmenu.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('/js/template/vendors/jquery-contextmenu/jquery.ui.position.js')}}"></script>


<script type="text/javascript"
        src="{{asset('/js/template/vendors/tables.js')}}"></script>

<script type="text/javascript" src="{{asset('/js/template/scripts-init/form-components/form-wizard.js')}}"></script>
<script type="text/javascript" src="{{asset('js/template/scripts-init/datepicker.init.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/blockui.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/app.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/form_floating_labels.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/pickerdate.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/summernote/summernote-lite.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/vendors/carousel-slider.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/template/scripts-init/carousel-slider.min.js')}}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header" id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a href="{{ url('/home') }}" class="link_logo_header navbar-brand">
                    <img class="app-logo" src="{{asset('/svg/tradinos_logo_horizontal_dark_blue.svg')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="app-main ">
            <div class="app-main__outer">
                @yield('content')

                <div class="app-wrapper-footer ">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="margin-h-center">
                                All Rights Reserved for Tradinos Test
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@yield('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
