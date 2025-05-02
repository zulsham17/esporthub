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
        <div id="custom-toast-container" class="position-fixed top-0 right-0 mt-5 mr-5" style="z-index: 1050;"></div>
        <div class="row align-items-center h-100">
            <form class="col-lg-6 col-md-8 col-10 mx-auto" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mx-auto text-center my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('landing-page')}}">
                        <!-- <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                            <g>
                                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                            </g>
                        </svg> -->
                        <img src="{{ asset('assets/img/stdc-logo-png.png') }}" width="28%">
                    </a>
                    <h2 class="my-3">Daftar Pengguna</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">No Matrik</label>
                        <input type="text" class="form-control" name="matric" id="inputEmail4">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" name="email" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Sektor</label>
                        <select class="form-control" name="sector" id="inputEmail4">
                            <option>-- Sila Pilih Sektor --</option>
                            <option value="Teknologi Maklumat">Teknologi Maklumat</option>
                            <option value="Kejuruteraan">Kejuruteraan</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Perakaunan">Perakaunan</option>
                            <option value="Sains Kesihatan">Sains Kesihatan</option>
                            <option value="Pentadbiran Awam">Pentadbiran Awam</option>
                            <option value="Undang-Undang">Undang-Undang</option>
                            <option value="Seni & Reka Bentuk">Seni & Reka Bentuk</option>
                            <option value="Perniagaan">Perniagaan</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">No Telefon</label>
                        <input type="text" name="phone_no" class="form-control">
                    </div>
                </div>
                <hr class="my-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPassword5">Kata Laluan</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPassword6">Sahkan Kata Laluan</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="confrimPassword">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">Keperluan Kata Laluan</p>
                        <p class="small text-muted mb-2">Untuk mencipta kata laluan baharu, anda perlu memenuhi semua keperluan berikut:</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li>Minimum 8 aksara</li>
                            <li>Sekurang-kurangnya satu aksara khas</li>
                            <li>Sekurang-kurangnya satu nombor</li>
                            <li>Tidak boleh sama seperti kata laluan sebelumnya</li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
                <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
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