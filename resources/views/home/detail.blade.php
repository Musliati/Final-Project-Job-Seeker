@extends('home.templates.index')

@section('page-content')
    <style>
        .price-wrapper {
            background-color: #333333;
            padding: 10px;
            width: 100%;
            text-align: center;
            border-radius: 5px;
            display: inline-block;
            color: #fff;
            margin-top: 10px;
        }

        .price {
            margin: 0;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
        }

        .quantity-input {
            width: 60px;
            margin: 0 10px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .quantity-btn {
            background-color: #3498DB;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .description {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        /* Menambahkan padding dan styling untuk tombol */
        .lamar-btn {
            background-color: #3498DB !important;
            color: black !important;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            border: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .lamar-btn:hover {
            background-color: #2980b9 !important;
        }

        .modal-dialog {
            max-width: 800px;
        }
    </style>

    <section class="ftco-section">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('foto/' . $loker->foto) }}" class="image-popup prod-img-bg">
                        <img src="{{ asset('foto/' . $loker->foto) }}" width="100%" alt="Product Image">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 style="color: black;">{{ $loker->namapekerjaan }}</h3>
                    <hr>
                    <div class="price-wrapper">
                        <p class="price"><span style="color: white">Rp.
                                {{ number_format($loker->rentanggajiawal) . ' - ' . number_format($loker->rentanggajiakhir) }}</span>
                        </p>
                    </div>

                    <!-- Deskripsi Pekerjaan -->
                    <div class="description card py-2 px-2 mt-4">
                        <h2 class="text-black">Deskripsi :</h2>
                        <p>{!! $loker->deskripsi !!}</p>
                    </div>

                    <!-- Tombol untuk membuka modal -->
                    <button class="lamar-btn" data-toggle="modal" data-target="#lamarModal">
                        Lamar
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="lamarModal" tabindex="-1" role="dialog" aria-labelledby="lamarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lamarModalLabel">Lamar Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('home/lamar') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idloker" value="{{ $loker->idloker }}">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namalengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" name="namalengkap" id="namalengkap" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="nohp">No HP:</label>
                            <input type="text" class="form-control" name="nohp" id="nohp" required>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="file">Upload CV</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Lamar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
