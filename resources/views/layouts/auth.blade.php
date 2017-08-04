<!doctype html>
<html class="no-js" lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>آویسا | حساب کاربری - ورود</title>
    <meta name="description" content="آموزش‌های متنوع و بروز را در آویسا بیابید و به راحتی بر دانش خود بیافزایید.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:site_name" content="آویسا"/>
    <meta property="og:description" content="آویسا، راه‌کارهای آموزش مجازی"/>
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('dist/styles/others.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('dist/styles/main.css') }}">
</head>
<body class="p-login-body ">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<noscript>
    جاوااسکریپت در مرورگر شما فعال نمی‌باشد. لطفا برای مشاهده بهترین نمایش جاوااسکریپت را فعال نمایید.
</noscript>
<header class="main" id="top-header">
    <div class="container header-body">
        <div class="row">
            <div class="col-sm-12">
                @include('home.nav-bar')
            </div>
        </div>
    </div>

</header>
<div class="wrapper">
    @yield('content')
</div>
<script src="{{ asset('dist/js/others.js') }}"></script>
<script src="{{ asset('dist/js/main.js') }}"></script>
<script src="{{ asset('dist/vendor/parsley.min.js') }}"></script>

@yield('scripts')
</body>
</html>