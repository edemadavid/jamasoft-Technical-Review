<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('AuthAssets/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('AuthAssets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('AuthAssets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('AuthAssets/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    @yield('content')


    <!--===============================================================================================-->
    <script src="{{ asset('AuthAssets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('AuthAssets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('AuthAssets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('AuthAssets/js/main.js') }}"></script>

</body>

</html>
