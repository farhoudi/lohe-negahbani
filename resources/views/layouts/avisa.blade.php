<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>آویسا - @yield('page_title', 'آموزش و یادگیری سریع آنلاین')</title>
    <meta name="description" content="سامانه آموزش مجازی آویسا">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('dist/favicon.png') }}"/>
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('dist/styles/others.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('dist/vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('dist/styles/main.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/raty-2.7.1/lib/jquery.raty.css') }}">
    @yield('styles')
    <script src="{{ asset('vendor/novin-ajax-1.0.0/novinajax.js') }}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
    </script>
    @yield('top_scripts')
</head>
<body>

<header class="main" id="top-header">
    <div class="container header-body">
        <div class="row">
            <div class="col-sm-12">
                @include('elements.navbar')
            </div>
        </div>
    </div>
</header>

<div class="wrapper">

    @include('vendor.flash.message')

    @yield('content')

</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 pull-left">
                <div class="footer-logo">
                    <img src="{{ asset('dist/images/logo.png') }}" alt="Avisa Logo"/>
                </div>
                <div class="copyright-sub-desc">
                    copyright © 2016-{{ date('Y') }} {{ config('app.url') }}
                </div>
            </div>
            <div class="col-sm-9 hidden-xs">
                <ul class="footer-menu">
                    <li><a href="{{ url('about') }}">درباره ما</a></li>
                    <li><a href="{{ url('contact') }}">ارتباط با ما</a></li>
                    <li><a href="{{ url('terms') }}">قوانین</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('dist/js/others.js') }}"></script>
<script src="{{ asset('dist/js/main.js') }}"></script>
<script src="{{ asset('vendor/raty-2.7.1/lib/jquery.raty.js') }}"></script>

@yield('scripts')
</body>
</html>