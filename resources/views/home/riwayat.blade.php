@extends('home.templates.index')

@section('page-content')
    <section id="home-section" class="ftco-section">
        <div class="container mt-4">
            <h1 style="color: black; font-weight:bold;">Riwayat Lamaran</h1>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <div class="table-responsive"> <!-- Added this div for responsiveness -->
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th style="color: black;" width="10px">No</th>
                                        <th style="color: black;" width="25%">Nama Pelamar</th>
                                        <th style="color: black;" width="25%">Nama Loker</th>
                                        <th style="color: black;">Email</th>
                                        <th style="color: black;">No HP</th>
                                        <th style="color: black;">File CV</th>
                                        <th style="color: black;">Keterangan</th>
                                        <th style="color: black;">Status</th>
                                        <th style="color: black;">Tanggal</th>
                                        <th style="color: black;">Catatan</th>
                                        <th style="color: black;">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    @foreach ($pelamar as $value)
                                        <tr>
                                            <td style="color: black;"><?php echo $nomor; ?></td>
                                            <td style="color: black;">{{ $value->namalengkap }}</td>
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
                                            <td style="color: black;">
                                                <form action="{{ url('home/hapuspelamar/' . $value->idpelamar) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- End of table-responsive -->
                    </div>
                    <div class="text-center">
                        {{ $pelamar->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
