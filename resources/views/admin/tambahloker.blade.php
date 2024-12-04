@extends('admin.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Tambah Loker</h6>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ url('admin/simpanloker') }}">
                        @csrf

                        @if (session('pengguna')->level == 'Admin')
                            <div class="form-group">
                                <label>Nama Employer</label>
                                <select name="idemployer" id="idemployer" class="form-control select2">
                                    <option value="" selected disabled>Pilih Employer</option>
                                    @foreach ($employer as $e)
                                        <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Nama Pekerjaan</label>
                            <input type="text" class="form-control" name="namapekerjaan" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <select class="form-control" name="idkategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->idkategori }}">{{ $k->namakategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" required>
                        </div>
                        <div class="form-group">
                            <label>Tipe Pekerjaan</label>
                            <select name="tipe" class="form-control" id="tipe">
                                <option value="" selected disabled>Pilih Tipe Pekerjaan</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="number" class="form-control" name="kontak" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Rentang Gaji Dari (Rp)</label>
                            <input type="number" class="form-control" name="rentanggajiawal" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Rentang Gaji Sampai (Rp)</label>
                            <input type="number" class="form-control" name="rentanggajiakhir" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="letak-input" style="margin-bottom: 10px;">
                                <input type="file" class="form-control" name="foto" required>
                            </div>
                        </div>
                        <button class="btn btn-secondary" name="save"><i
                                class="glyphicon glyphicon-saved"></i>Simpan</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
