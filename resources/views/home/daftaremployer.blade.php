<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Employer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('foto/logonya.jpeg') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .registration-form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .registration-form h2 {
            margin-bottom: 20px;
        }

        .registration-form .form-group label {
            font-weight: bold;
        }

        .btn-register {
            background-color: #3498DB;
            color: #fff;
            border: none;
        }

        .btn-register:hover {
            color: white;
            background-color: #05426b;
        }

        .login-link {
            margin-top: 10px;
            display: block;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="registration-form mt-5">
                    <h2 class="text-center">Registrasi Employer</h2>
                    <p class="text-center">Silahkan melakukan registrasi dengan menggunakan data Anda yang valid</p>
                    <form method="post" action="{{ url('home/dodaftaremployer') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama Lengkap*</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telepon">No. Telephone*</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                                @error('telepon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tempatLahir">Tempat Lahir*</label>
                                <input type="text" class="form-control" id="tempatLahir" name="tempat_lahir"
                                    required>
                                @error('tempat_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tanggalLahir">Tanggal Lahir*</label>
                                <input type="date" class="form-control" id="tanggalLahir" name="tgl_lahir" required>
                                @error('tgl_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jenisKelamin">Jenis Kelamin*</label>
                                <select class="form-control" id="jenisKelamin" name="jekel" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jekel')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Password*</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Konfirmasi Password*</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="alamat">Alamat*</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-register btn-block">Registrasi</button>
                        <a href="/home/login" class="login-link" style="color: black;">Sudah punya akun? <span
                                style="color: #3498DB;">Login</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;

            if (password !== password_confirmation) {
                event.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Password dan Konfirmasi Password tidak cocok!',
                    icon: 'error'
                });
            }
        });
    </script>

</body>

</html>
