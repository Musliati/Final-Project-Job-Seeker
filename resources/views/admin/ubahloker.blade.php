@extends('admin.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Ubah Loker</h6>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data"
                        action="{{ url('admin/updateloker/' . $loker->idloker) }}">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pekerjaan</label>
                            <input type="text" class="form-control" name="namapekerjaan"
                                value="{{ $loker->namapekerjaan }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <select class="form-control" name="idkategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->idkategori }}"
                                        {{ $loker->idkategori == $k->idkategori ? 'selected' : '' }}>
                                        {{ $k->namakategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" value="{{ $loker->lokasi }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tipe Pekerjaan</label>
                            <select name="tipe" class="form-control" id="tipe" required>
                                <option value="Full Time" {{ $loker->tipe == 'Full Time' ? 'selected' : '' }}>Full Time
                                </option>
                                <option value="Part Time" {{ $loker->tipe == 'Part Time' ? 'selected' : '' }}>Part Time
                                </option>
                                <option value="Freelance" {{ $loker->tipe == 'Freelance' ? 'selected' : '' }}>Freelance
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="number" class="form-control" name="kontak" value="{{ $loker->kontak }}" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10" required>{{ $loker->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Rentang Gaji Dari (Rp)</label>
                            <input type="number" class="form-control" name="rentanggajiawal"
                                value="{{ $loker->rentanggajiawal }}" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Rentang Gaji Sampai (Rp)</label>
                            <input type="number" class="form-control" name="rentanggajiakhir"
                                value="{{ $loker->rentanggajiakhir }}" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="letak-input" style="margin-bottom: 10px;">
                                <input type="file" class="form-control" name="foto">
                                @if ($loker->foto)
                                    <img src="{{ asset('foto/' . $loker->foto) }}" width="100px" class="mt-2">
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-secondary" name="update"><i class="glyphicon glyphicon-save"></i>
                            Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
