<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('AdminAssets/img/icons/icon-48x48.png') }}" />

    <title>Jamasoft Admin</title>

    <link href="https://fonts.googleapis.com/css274d5.css?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">

    <link href="{{ asset('AdminAssets/css/light.css')}}" rel="stylesheet">
    <!-- <link href="{{ asset('AdminAssets/css/dark.css')}}" rel="stylesheet"> -->

</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        @include('components.admin-nav')
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">


                        <li class="nav-item">
                            <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="maximize"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <img src="{{asset('AdminAssets/img/avatars/avatar.jpg')}}" class="avatar img-fluid rounded" alt=" {{ Auth::user()->name}}" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class='dropdown-item' href='#'>
                                    <i class="align-middle me-1" data-feather="user"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="container-fluid p-0">
                    @yield('contents')
                </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" target="_blank" class="text-muted"><strong>Synewxve</strong></a> &copy;
                            </p>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('AdminAssets/js/app.js')}}"></script>
    <script src="{{ asset('AdminAssets/js/notyf.js')}}"></script>
    @yield('extraJS')


    <script>
        var notyf = new Notyf({
            duration: 10000, // Duration in milliseconds (10 seconds)
            position: {
                x: "right",
                y: "top"
            },
            duration: 10000, // Duration in milliseconds (10 seconds)
            ripple: true,
            dismissible: false,
        });
    </script>

    @if (session('success'))
    <script>
        notyf.success({
            message: "{{ session('success') }}",
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        notyf.error({
            message: "{{ $errors->first() }}",
        });
    </script>
    @endif
</body>

</html>
