<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>SportHub STDC - Daftar Pengguna</title>
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

</head>

<body class="dark">
    <div class="wrapper vh-100 scrollable">
        <a href="{{ route('login-page') }}" class="btn btn-secondary btn-md m-3"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
        <div id="custom-toast-container" class="position-fixed top-0 right-0 mt-5 mr-5" style="z-index: 1050;"></div>
        <div class="row align-items-center h-100">
            <div class="col-lg-6 col-md-8 col-11 mx-auto">

                <div class="card border-white shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mx-auto text-center mb-4">
                                <a class="navbar-brand flex-fill text-center" href="{{route('landing-page')}}">
                                    <img src="{{ asset('assets/img/stdc-logo-png.png') }}" width="28%">
                                </a>
                                <h2 class="my-3">Daftar Pengguna</h2>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>No Matrik</label>
                                    <input type="text" class="form-control" name="matric">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Sektor</label>
                                    <select class="form-control" name="sector">
                                        <option>-- Sila Pilih Sektor --</option>
                                        <option value="Sistem Komputer">Sistem Komputer</option>
                                        <option value="Tekstil Pakaian">Tekstil Pakaian</option>
                                        <option value="Elektrik">Elektrik</option>
                                        <option value="Automotif">Automotif</option>
                                        <option value="Motosikal">Motosikal</option>
                                        <option value="Kulinari">Kulinari</option>
                                        <option value="Pastri">Pastri</option>
                                        <option value="Penyaman Udara">Penyaman Udara</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>No Telefon</label>
                                    <input type="text" name="phone_no" class="form-control">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kata Laluan</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Sahkan Kata Laluan</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror">
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-2 font-weight-bold">Keperluan Kata Laluan</p>
                                    <p class="small text-muted mb-2">
                                        Untuk mencipta kata laluan baharu, anda perlu memenuhi semua keperluan berikut:
                                    </p>
                                    <ul class="small text-muted pl-4 mb-0">
                                        <li>Minimum 8 aksara</li>
                                        <li>Sekurang-kurangnya satu aksara khas</li>
                                        <li>Sekurang-kurangnya satu nombor</li>
                                        <li>Tidak boleh sama seperti kata laluan sebelumnya</li>
                                    </ul>
                                </div>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block" type="submit">
                                Daftar
                            </button>

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
    <script>
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirm = this.value;

            if (confirm !== password) {
                this.setCustomValidity("Kata laluan tidak sepadan.");
            } else {
                this.setCustomValidity("");
            }
        });
    </script>

</body>

</html>
</body>

</html>