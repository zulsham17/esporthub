<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>SportHub STDC - Log Masuk</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">

    <!-- Fonts CSS (Google Fonts external link — no change needed) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="darkTheme">
    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body class="dark ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <div class="col-lg-4 col-md-6 col-11 mx-auto">

                <div class="card shadow-sm border-white" style="border-radius: 12px;">
                    <div class="card-body p-4">

                        <form method="post" action="{{ route('login') }}">
                            @csrf

                            <div class="text-center mb-3">
                                <a class="navbar-brand mx-auto flex-fill text-center" href="{{ route('landing-page') }}">
                                    <img src="{{ asset('assets/img/stdc-logo-png.png') }}" width="48%">
                                </a>
                            </div>

                            <h1 class="h4 text-center mb-4">Log Masuk</h1>

                            <div class="form-group">
                                <label for="inputEmail" class="sr-only">Email</label>
                                <input type="email" id="inputEmail" name="email" class="form-control form-control-lg" placeholder="Email">
                            </div>

                            <div class="form-group mt-3">
                                <label for="inputPassword" class="sr-only">Kata Laluan</label>
                                <input type="password" name="password" id="inputPassword"
                                    class="form-control form-control-lg" placeholder="Kata Laluan">
                                <div class="mt-2 text-right">
                                    <a href="{{ route('forgot-password-page') }}">Lupa Kata Laluan?</a>
                                </div>
                            </div>

                            @if($errors->any())
                            <div class="alert alert-danger mt-3">
                                {{ $errors->first() }}
                            </div>
                            @endif

                            <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">
                                Log Masuk
                            </button>

                            <div class="mt-4 text-center">
                                <a href="{{ route('register-page') }}">Daftar Pengguna Baru</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('assets/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>
</body>

</html>
</body>

</html>