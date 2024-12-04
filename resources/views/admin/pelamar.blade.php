@extends('admin.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Data Pelamar</h6>
                </div>
                <div class="card-body">
                    <!-- Tambahkan table-responsive di sini -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    @if (session('pengguna')->level == 'Admin')
                                        <th>Nama Employer</th>
                                    @endif
                                    <th>Nama Loker</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>File CV</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                @foreach ($pelamar as $value)
                                    <tr>
                                        <td style="color: black;"><?php echo $nomor; ?></td>
                                        <td style="color: black;">{{ $value->namalengkap }}</td>
                                        @if (session('pengguna')->level == 'Admin')
                                            <td style="color: black;">{{ $value->namaemployer }}</td>
                                        @endif
                                        <td style="color: black;">{{ $value->namapekerjaan }}</td>
                                        <td style="color: black;">{{ $value->email }}</td>
                                        <td style="color: black;">{{ $value->nohp }}</td>
                                        <td style="color: black;">
                                            @if (!empty($value->file) && file_exists(public_path('file/' . $value->file)))
                                                <a href="{{ asset('file/' . $value->file) }}"
                                                    class="btn btn-info">Lihat</a>
                                            @else
                                                <strong><span class="text-center">-</span></strong>
                                            @endif
                                        </td>
                                        <td style="color: black;">{{ $value->keterangan }}</td>
                                        <td style="color: black;">
                                            <a href="#" class="btn btn-info">{{ $value->status }}</a>
                                        </td>
                                        <td style="color: black;">{!! tanggal($value->tanggal) !!}</td>
                                        <td style="color: black;">{{ $value->catatan ?? '-' }}</td>
                                        <td>
                                            <a href="{{ url('admin/detailpelamar/' . $value->idpelamar) }}"
                                                class="btn btn-sm btn-info">Detail</a>

                                            @if (session('pengguna')->level == 'Employer')
                                                <a href="{{ url('admin/hapuspelamar/' . $value->idpelamar) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
