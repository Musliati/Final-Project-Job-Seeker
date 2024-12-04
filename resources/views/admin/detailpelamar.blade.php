@extends('admin.templates.index')

@section('page-content')
<style>
    /* Header detail pelamar */
    .detail-header {
        background-color: #3498DB;
        color: white;
        padding: 20px;
        border-radius: 10px 10px 0 0;
        display: flex;
        align-items: center;
    }

    .detail-header img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }

    /* Kartu detail pelamar */
    .detail-card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        background-color: white;
        margin-bottom: 20px;
    }

    .detail-content {
        padding: 20px;
    }

    .info-label {
        font-weight: bold;
        color: #555;
        display: inline-block;
        min-width: 150px;
    }

    /* Gaya untuk card info */
    .info-card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        padding: 15px;
    }

    .info-card h5 {
        margin-bottom: 10px;
        color: #333;
    }

    .info-card p {
        margin: 5px 0;
        color: #555;
    }

    .status-section h4 {
        margin-bottom: 20px;
        color: #333;
    }

    .form-control {
        margin-top: 5px;
    }

    .btn-primary {
        width: 100%;
    }

    /* Menjaga tampilan responsif */
    @media (max-width: 768px) {
        .detail-card {
            margin-bottom: 15px;
        }

        .detail-header {
            flex-direction: column;
            text-align: center;
        }

        .detail-header img {
            margin-bottom: 15px;
        }

        .detail-content {
            padding: 10px;
        }

        .info-label {
            display: block;
            margin-bottom: 5px;
        }
    }
</style>

<div class="container">
    <div class="row">
        <!-- Informasi Pelamar -->
        <div class="col-md-6">
            <div class="detail-card">
                <div class="detail-header">
                    {{-- <img src="{{ asset('path/to/avatar.jpg') }}" alt="Avatar"> --}}
                    <h2>{{ $pelamar->namalengkap }}</h2>
                </div>
                <div class="detail-content">
                    <!-- Card Email -->
                    <div class="info-card">
                        <h5>Email:</h5>
                        <p>{{ $pelamar->email }}</p>
                    </div>

                    <!-- Card No HP -->
                    <div class="info-card">
                        <h5>No HP:</h5>
                        <p>{{ $pelamar->nohp }}</p>
                    </div>

                    <!-- Card Keterangan -->
                    <div class="info-card">
                        <h5>Keterangan:</h5>
                        <p>{{ $pelamar->keterangan }}</p>
                    </div>

                    <h4 class="mt-4">Pekerjaan Yang Dilamar</h4>

                    <!-- Card Nama Pekerjaan -->
                    <div class="info-card">
                        <h5>Nama Pekerjaan:</h5>
                        <p>{{ $pelamar->namapekerjaan }}</p>
                    </div>

                    <!-- Card Tipe Pekerjaan -->
                    <div class="info-card">
                        <h5>Tipe:</h5>
                        <p>{{ $pelamar->tipe }}</p>
                    </div>

                    <!-- Card Deskripsi -->
                    <div class="info-card">
                        <h5>Deskripsi:</h5>
                        <div class="description-box">
                            {!! $pelamar->deskripsi !!}
                        </div>
                    </div>

                    <!-- Card Tanggal -->
                    <div class="info-card">
                        <h5>Tanggal:</h5>
                        <p>{{ tanggal($pelamar->tanggal) }}</p>
                    </div>

                    <!-- Card CV -->
                    <div class="info-card">
                        <h5>File CV:</h5>
                        @if (!empty($pelamar->file))
                        <a href="{{ asset('file/' . $pelamar->file) }}" class="btn btn-sm btn-info"
                            target="_blank">Lihat CV</a>
                        @else
                        Tidak ada file.
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if (session('pengguna')->level == 'Employer')
        <!-- Form Ubah Status Pelamar -->
        <div class="col-md-6">
            <div class="detail-card">
                <div class="detail-content status-section">
                    <h4>Ubah Status Pelamar</h4>
                    <form method="post" action="{{ url('admin/updatestatus/' . $pelamar->idpelamar) }}">
                        @csrf
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="form-control" onchange="toggleCatatan()">
                                <option value="Diproses" {{ $pelamar->status == 'Diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="Diterima" {{ $pelamar->status == 'Diterima' ? 'selected' : '' }}>
                                    Diterima</option>
                                <option value="Ditolak" {{ $pelamar->status == 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                        </div>
                        <div class="form-group" id="catatanField" style="display: none;">
                            <label for="catatan">Catatan:</label>
                            <textarea name="catatan" id="catatan"
                                class="form-control">{{ $pelamar->catatan ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

<script>
    // Tampilkan atau sembunyikan field catatan berdasarkan status
        function toggleCatatan() {
            const status = document.getElementById('status').value;
            const catatanField = document.getElementById('catatanField');
            if (status === 'Diterima' || status === 'Ditolak') {
                catatanField.style.display = 'block';
            } else {
                catatanField.style.display = 'none';
                document.getElementById('catatan').value = '';
            }
        }

        // Jalankan fungsi saat halaman dimuat untuk menyesuaikan tampilan awal
        window.onload = toggleCatatan;
</script>
@endsection