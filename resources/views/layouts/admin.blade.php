<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}">

    <style>
        body {
            padding-top: 70px;
            padding-bottom: 30px;
        }
    </style>

    @yield('custom-style')
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! action('Admin\DashboardController@index') !!}">Admin panel</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ str_contains(Route::currentRouteAction(), ['DashboardController@']) ? 'active' : '' }}">
                    <a href="{!! action('Admin\DashboardController@index') !!}">Dashboard</a>
                </li>
                <li class="dropdown {{ str_contains(Route::currentRouteAction(), ['ProductController@', 'CategoryController@']) ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Stuff <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ str_contains(Route::currentRouteAction(), ['ProductController@']) ? 'active' : '' }}">
                            <a href="{!! action('Admin\ProductController@index') !!}">Products</a>
                        </li>
                        <li class="{{ str_contains(Route::currentRouteAction(), ['CategoryController@']) ? 'active' : '' }}">
                            <a href="{!! action('Admin\CategoryController@index') !!}">Categories</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{!! action('Front\PageController@getHome') !!}">Go to site</a>
                </li>
            </ul>
        </div>

        {{--navbar-right--}}
    </div>
</nav>

<div class="container">

    @include('flash::message')

    @yield('content')

</div>

<script src="{{ asset('js/vendor.js') }}"></script>
@yield('custom-script')
</body>
</html>
