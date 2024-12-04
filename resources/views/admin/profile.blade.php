@extends('admin.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Profil Pengguna</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/updateprofile/' . $profile->id) }}">
                        @csrf
                        <div class="row">
                            <!-- Kolom Form -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="{{ $profile->nama }}">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $profile->email }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Nomor HP:</label>
                                    <input type="text" name="telepon" id="telepon" class="form-control"
                                        value="{{ $profile->telepon }}">
                                    @error('telepon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control"
                                        value="{{ $profile->alamat }}">
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir:</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                        value="{{ $profile->tgl_lahir }}">
                                    @error('tgl_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir:</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                        value="{{ $profile->tempat_lahir }}">
                                    @error('tempat_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jekel">Jenis Kelamin:</label>
                                    <select name="jekel" id="jekel" class="form-control">
                                        <option value="Laki-laki" {{ $profile->jekel == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan" {{ $profile->jekel == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jekel')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="4">{{ $profile->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsiketerampilan">Deskripsi Keterampilan:</label>
                                    <textarea name="deskripsiketerampilan" id="deskripsiketerampilan" class="form-control" rows="4">{{ $profile->deskripsiketerampilan }}</textarea>
                                    @error('deskripsiketerampilan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
