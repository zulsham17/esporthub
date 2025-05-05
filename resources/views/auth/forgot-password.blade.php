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
        <a href="{{ route('login-page') }}" class="btn btn-secondary btn-md m-3"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
        <div class="row align-items-center">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="post" action="{{route('forgot-password')}}">
                @csrf
                <div class="mx-auto text-center my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('landing-page')}}">
                        <img src="{{ asset('assets/img/stdc-logo-png.png') }}" width="48%">
                    </a>
                    <h3 class="my-3">Lupa kata laluan</h3>
                </div>
                <p class="text-muted">Sila masukkan alamat emel anda untuk dapatkan kata laluan sementara</p>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" name="email" class="form-control form-control-lg" placeholder="Alamat Email">
                </div>
                <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Hantar</button>
                @if(session('success'))
                <div>{{ session('success') }}</div>
                @endif

                @error('email')
                <div>{{ $message }}</div>
                @enderror
            </form>

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