@if (!session('pengguna'))
    <script>
        alert('Anda Harus Login');
        location = '{{ url('home/login') }}';
    </script>
@endif
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Jobseeker - {{ session('pengguna')->level }}</title>
    <link href="{{ asset('assets/admin/css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/css/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ asset('assets/admin/css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <script src="{{ asset('assets/admin/assets/ckeditor/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        .btn-secondary {
            background-color: #3498DB;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #194979;
        }

        .btn-secondary:active,
        .btn-secondary:focus {
            background-color: #194979;
            outline: none;
            /* Menghilangkan outline saat fokus */
            box-shadow: none;
            /* Menghilangkan box-shadow default */
        }

        .bg-coklat {
            background-color: #3498DB;
        }

        .dropdown-menu .dropdown-item {
            color: #000;
            /* Warna teks default item */
        }

        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:active {
            background-color: #194979;
            /* Warna latar belakang saat hover atau aktif */
            color: #fff;
            border: 1px solid #3498DB !important;
            /* Warna teks saat hover atau aktif */
        }

        .alerts-header {
            background-color: #3498DB !important;
            /* Warna Coklat */
            color: white !important;
            /* Teks Putih jika diinginkan */
            border: 1px solid #3498DB !important;
        }

        /* Menambahkan background color pada elemen yang aktif */
        .nav-item.active>.nav-link {
            background-color: #194979 !important;
            color: white !important;
            border-radius: 5px;
        }

        /* Menambahkan hover effect pada elemen aktif jika diinginkan */
        .nav-item.active>.nav-link:hover {
            background-color: #194979;
            color: white;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #222D32;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center text-white"
                style="background-color: #194979" href="{{ url('admin') }}">
                <div class="sidebar-brand-text mx-3">Jobseeker</div>
            </a>
            <hr class="sidebar-divider">

            <!-- Profile Section -->
            <div class="sidebar-profile d-flex align-items-center">
                <img class="img-profile rounded-circle mr-2" src="{{ asset('foto/avatar.png') }}" alt="Avatar"
                    width="80">
                <div>
                    <span class="text-white">{{ session('pengguna')->nama }}</span>
                    <br>
                    {{-- <span class="badge badge-success">Online</span> --}}
                </div>
            </div>
            <hr class="sidebar-divider">

            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a class="nav-link text-white" href="{{ url('admin') }}">
                    <i class="fas fa-fw fa-book text-white"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (session('pengguna')->level == 'Admin')
                <hr class="sidebar-divider">
                <li
                    class="nav-item {{ request()->is('admin/kategori') || request()->is('admin/tambahkategori') || request()->is('admin/ubahkategori/*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/kategori') }}">
                        <i class="fas fa-fw fa-list text-white"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li
                    class="nav-item {{ request()->is('admin/loker') || request()->is('admin/tambahloker') || request()->is('admin/ubahloker/*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/loker') }}">
                        <i class="fas fa-fw fa-briefcase text-white"></i>
                        <span>Loker</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li
                    class="nav-item {{ request()->is('admin/pelamar') || request()->is('admin/detailpelamar/*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/pelamar') }}">
                        <i class="fas fa-fw fa-user-check text-white"></i>
                        <span>Pelamar</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item {{ request()->is('admin/pengguna') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/pengguna') }}">
                        <i class="fas fa-fw fa-users text-white"></i>
                        <span>Data Pengguna</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li
                    class="nav-item {{ request()->is('admin/employer') || request()->is('admin/tambahemployer') || request()->is('admin/ubahemployer/*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/employer') }}">
                        <i class="fas fa-fw fa-users text-white"></i>
                        <span>Data Employer</span>
                    </a>
                </li>
            @endif

            @if (session('pengguna')->level == 'Employer')
                <hr class="sidebar-divider">
                <li
                    class="nav-item {{ request()->is('admin/loker') || request()->is('admin/tambahloker') || request()->is('admin/ubahloker/*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/loker') }}">
                        <i class="fas fa-fw fa-briefcase text-white"></i>
                        <span>Loker</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li
                    class="nav-item {{ request()->is('admin/pelamar') || request()->is('admin/detailpelamar/*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('admin/pelamar') }}">
                        <i class="fas fa-fw fa-user-check text-white"></i>
                        <span>Pelamar</span>
                    </a>
                </li>
            @endif
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow"
                    style="background-color: #3498DB">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <!-- User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{ asset('foto/avatar.png') }}">
                                <span
                                    class="mr-2 d-none d-lg-inline text-white small">{{ session('pengguna')->nama }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('admin/profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ url('admin/logout') }}"
                                    onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?');">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <div class="container-fluid">
                    <div id="page-inner">
                        @if (Session::has('alert'))
                            <div class="alert alert-primary">
                                {{ Session::get('alert') }}
                            </div>
                        @endif
                        @yield('page-content')
                    </div>
                </div>
            </div>
            <script src="{{ asset('assets/admin/assets/js/jquery-1.10.2.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/jquery.metisMenu.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/morris/raphael-2.1.0.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/morris/morris.js') }}"></script>
            <script src="{{ asset('assets/admin/css/js/sb-admin-2.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}">
            </script>
            <script src="{{ asset('assets/admin/assets/DataTables/JSZip-2.5.0/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/Buttons-1.5.6/js/buttons.colvis.min.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
             
            <script>
                // Toggle the sidebar
                $("#sidebarToggleTop").on('click', function() {
                    $("body").toggleClass("sidebar-toggled");
                    $(".sidebar").toggleClass("toggled");
                    if ($(".sidebar").hasClass("toggled")) {
                        $('.sidebar .collapse').collapse('hide');
                    }
                });
            </script>

            <script>
                $('.select2').select2();
            </script>

            @yield('script')
</body>

</html>
