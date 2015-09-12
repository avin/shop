<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}">
    @yield('custom-style')
</head>
<body>

@yield('content')

<script src="{{ asset('js/vendor.js') }}"></script>
@yield('custom-script')
</body>
</html>
