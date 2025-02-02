<!DOCTYPE html>
<html lang="en">

<head>
    <title>Jobseeker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/home/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/style.css') }}">
    {{--
    <link rel="icon" type="image/x-icon" href="{{ asset('foto/logonya.jpeg') }}"> --}}
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <script src="{{ asset('assets/admin/assets/ckeditor/ckeditor.js') }}"></script>


</head>

<body>
    @if (session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
    @endif

    <nav class="navbar navbar-expand-lg navbar-danger ftco_navbar bg-white ftco-navbar-light" id="ftco-navbar"">
        <div class=" container">
        {{-- <img src="{{ asset('foto/logonya1.png') }}" href="{{ url('home') }}" width="80"> --}}
        <a class="navbar-brand" href="{{ url('') }}" style="color: #3498DB">
            Jobseeker
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-list" style="color: #000 !important;"></i>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{ url('home') }}" class="nav-link ">Home</a></li>
                <li class="nav-item"><a href="{{ url('home/lokerdaftar') }}" class="nav-link">Loker</a></li>
                <li class="nav-item"><a href="{{ url('home/kategori') }}" class="nav-link">Kategori</a></li>
                <li class="nav-item dropdown">
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        @php
                        $datakategori = DB::table('kategori')->get();
                        @endphp
                        @foreach ($datakategori as $key => $value)
                        <a href="{{ url('home/kategori/' . $value->idkategori) }}" class="dropdown-item">{{
                            $value->namakategori }}</a>
                        @endforeach
                    </div>
                </li>

                @if (session('pengguna') || session('pengguna'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" style="color:black;"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @if (session('pengguna') && session('pengguna')->level == 'Employer')
                        <a class="dropdown-item" href="{{ url('admin') }}">Dashboard Employer</a>
                        @endif
                        @if (session('pengguna') && session('pengguna')->level == 'Admin')
                        <a class="dropdown-item" href="{{ url('admin') }}">Dashboard</a>
                        @endif
                        @if (session('pengguna') && session('pengguna')->level == 'Pelamar')
                        <a class="dropdown-item" href="{{ url('home/daftaremployer') }}">Daftar
                            Employer</a>
                        @endif
                        <a class="dropdown-item" href="{{ url('home/akun') }}">Profil Akun</a>
                        <a class="dropdown-item" href="{{ url('home/riwayat') }}">Riwayat Lamaran</a>
                        <a class="dropdown-item" href="{{ url('home/logout') }}">Logout</a>
                    </div>
                </li>
                @else
                <li class="nav-item active ml-2">
                    <a href="{{ url('home/login') }}" class="nav-link btn py-2 px-3 mt-3"
                        style="background-color: #3498DB; color: black !important;">Masuk</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ url('home/daftar') }}" class="nav-item nav-link btn py-2 px-2 mt-3 ml-3"
                        style="background-color: #ffffff; color: black !important; border: solid #3498DB 1px;">Daftar</a>
                </li>
                @endif
            </ul>
        </div>
        </div>
    </nav>


    @yield('page-content')

    <footer class="ftco-footer mt-5" style="background-color: #24262B;">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-2">
                    <div class="ftco-footer-widget mb-4">
                        <h3>Jobseeker</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2" style="color:#3498DB;"> OFFLINE OFFICE</h2>
                        <p style="margin-top: -20px">Alamat :</p>
                        <p style="margin-top: -20px">Perintis Kemerdekaan</p>
                        <p>Telepon : </p>
                        <p style="margin-top: -20px">0822-1103-0791 (Whatsapp)</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2" style="color:#3498DB;">JAM OPERASIONAL :</h2>
                        <p>Senin - Kamis :</p>
                        <p style="margin-top: -20px">08.00 - 16.00 WIB</p>
                        <p style="margin-top: -20px">Sabtu - Minggu</p>
                        <p style="margin-top: -20px">08.00 - 16.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer style="background-color: #3498DB;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-3" style="color: #000">
                    <p>Copyright © 2024 Jobseeker | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <style>

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-100%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-100%);
            }
        }
    </style>

    <script src="{{ asset('assets/home/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/home/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('assets/home/js/google-map.js') }}"></script>
    <script src="{{ asset('assets/home/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}!",
                icon: "success"
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}!",
                icon: "error"
            });
        @endif
    </script>
</body>

</html>