<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/master.css') }}">

    @yield('custom-style')
</head>
<body>



<div class="container">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
                <a class="navbar-brand" href="#">MyShop</a>
            </div>
            <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
            <div id="navbar">
                <ul class="nav navbar-nav">
                    <li class="{{ str_contains(Route::currentRouteAction(), ['PageController@getHome']) ? 'active' : '' }}"><a href="{!! action('Front\PageController@getHome') !!}">Home</a></li>
                    <li class="{{ str_contains(Route::currentRouteAction(), ['PageController@getAbout']) ? 'active' : '' }}"><a href="{!! action('Front\PageController@getAbout') !!}">About</a></li>
                    <li class="{{ str_contains(Route::currentRouteAction(), ['PageController@getContact']) ? 'active' : '' }}"><a href="{!! action('Front\PageController@getContact') !!}">Contact</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! action('Front\ProductController@index') !!}">All products</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{!! action('Front\CategoryController@index') !!}">Categories</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search product">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li>{!! link_to_action('Front\CartController@show', $title = 'Cart') !!}</li>
                        <li>{!! link_to_action('Front\ProfileController@show', $title = 'Profile') !!}</li>
                        <li>{!! link_to_action('Auth\AuthController@getLogout', $title = 'Logout') !!}</li>
                    @else
                        <li>{!! link_to_action('Auth\AuthController@getLogin', $title = 'Log in') !!}</li>
                        <li>{!! link_to_action('Auth\AuthController@getRegister', $title = 'Register') !!}</li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        @include('flash::message')

        @yield('content')

    </div>



</div>

<script src="{{ asset('js/vendor.js') }}"></script>
@yield('custom-script')
</body>
</html>
