<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>لوح نگهبانی - @yield('page_title', 'داشبورد')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="{{ asset('dist/favicon.png') }}"/>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-rtl-3.3.6/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-4.0.2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte-rtl-2.3.3/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte-rtl-2.3.3/css/skins/_all-skins.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/ionicons-2.0.1/css/ionicons.min.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body, .main-header .logo { font-family: IRANSans, Tahoma, Arial, serif; }
        body.sidebar-collapse .logo b { font-size: x-small; }
        h1, h2, h3, h4, h5, h6 { font-family: byekan, Tahoma, Arial, serif; }
    </style>

    @yield('styles')

    @yield('top-scripts')
</head>

<body class="skin-blue sidebar-mini">

    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>لوح نگهبانی</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                {{--<img src="{{ asset('img/logo/150x150.png') }}"--}}
                                     {{--class="user-image" alt="User Image"/>--}}
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
{{--                                <span class="hidden-xs">{!! request()->user()->full_name !!}</span>--}}
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header" style="height: auto;">
                                    {{--<img src="{{ asset('img/logo/150x150.png') }}"--}}
                                         {{--class="img-circle" alt="User Image"/>--}}
                                    <p>
{{--                                        {!! request()->user()->name . ' ' . request()->user()->family !!}--}}
{{--                                        <small>{{ trans('users.member_since') }}: {!! jdate('F Y', strtotime(request()->user()->created_at->format('Y-m-d'))) !!}</small>--}}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    {{--<div class="pull-left">--}}
                                        {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                                    {{--</div>--}}
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ trans('auth.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{--@include('flash::message')--}}
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if (request()->session()->has($msg))
                        <p class="alert alert-{{ $msg }}">
                            {{ request()->session()->get($msg) }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                    @endif
                @endforeach
            </div> <!-- end .flash-message -->

            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>کلیه حقوق مادی و معنوی محفوظ می باشد.</strong>
        </footer>

    </div>


    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('vendor/jquery-1.12.0/jquery.min.js') }}"></script>
    {{--<script src="{{ asset('vendor/bootstrap-3.3.6/js/bootstrap.min.js') }}"></script>--}}
    <script src="{{ asset('vendor/bootstrap-rtl-3.3.6/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2-4.0.2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2-4.0.2/js/i18n/fa.js') }}"></script>
    <script src="{{ asset('vendor/icheck-1.0.2/icheck.min.js') }}"></script>

    <!-- AdminLTE App -->
    {{--<script src="{{ asset('vendor/admin-lte-2.3.3/js/app.min.js') }}"></script>--}}
    <script src="{{ asset('vendor/admin-lte-rtl-2.3.3/js/app.js') }}"></script>

    <!-- Datatables -->
    {{--<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>--}}

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
        $('.multiselect').select2({
            dir: 'rtl',
            language: 'fa'
        });
    </script>

    @yield('scripts')
</body>
</html>