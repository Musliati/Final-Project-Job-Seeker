@extends('home.templates.index')

@section('page-content')
    <style>
        <style>.product {
            position: relative;
        }

        .sale-label {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #3498DB;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            z-index: 10;
        }
    </style>

    </style>

    <section class="ftco-section">
        <div class="container">
            <div class="mb-5">
                <h1 style="color: black; font-weight:bold;">Lowongan Kerja</h1> 
                <p style="color: black;">Temukan pekerjaan impian Anda sekarang juga!</p>

            </div>
            <div class="row">
                @foreach ($loker as $p)
                    <div class="col-md-4 d-flex">
                        <div class="product ftco-animate">
                            <span class="sale-label">Dibuka</span>
                            <div class="img d-flex align-items-center justify-content-center"
                                style="background-image: url('{{ asset('foto/' . $p->foto) }}');">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="{{ url('home/detail/' . $p->idloker) }}"
                                            class="d-flex align-items-center justify-content-center">
                                            <span class="flaticon-visibility"></span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                <span class="category">{{ $p->namakategori }} | </span>
                                <span class="price">{{ $p->namapekerjaan }}</span>
                                <p class="text-right" style="color: #3498DB; font-weight:bold;">Rp
                                    {{ number_format($p->rentanggajiawal) . ' - ' . number_format($p->rentanggajiakhir) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                {{ $loker->links() }}
            </div>
        </div>
    </section>
@endsection
