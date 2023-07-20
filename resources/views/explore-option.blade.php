@extends('template.template')

@section('title')
Dronezone
@endsection

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/explore-option.css') }}">
</head>

<body>
    <div class="option-container">
        <div class="option">
            <div class="option-box">
                <div class="option-text">
                    <label class="option-content">Cari Mitra <br>Dronemu Sekarang!</label>
                    <div class="option-content-desc">
                        <label class="desc-left">
                            Cari mitra drone untuk menjadi teman perjalanan anda, mengabadikan momen tak terlupakan
                            bersama keluarga, pesta pernikahan, hingga liburan honeymoon. Temukan berbagai macam mitra
                            penyedia jasa drone disekitar anda di Surabaya sekarang.
                        </label>
                    </div>
                    <a href="{{ route('general') }}" style="text-decoration: none;">
                        <div class="option-button">Temukan Disini</div>
                    </a>
                </div>
                <div class="option-image">
                    <img src="img/wedding.jpg"
                        style="float: right; width: 500px; height: 400px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;" />
                </div>
            </div>
            <div class="option-box-second">
                <div class="option-text-second">
                    <label class="option-content-second">Butuh Mitra <br>Drone Profesional?</label>
                    <div class="option-content-desc-second">
                        <label>
                            Cari mitra persewaan drone untuk kebutuhan profesional anda di Surabaya dengan pilot yang
                            terpercaya, portofolio mitra dan tersertifikasi oleh Dinas Perhubungan. Temukan berbagai
                            macam mitra sesuai lokasi yang anda inginkan di Surabaya sekarang.
                        </label>
                    </div>
                    <a href="{{ route('professional') }}" style="text-decoration: none;">
                        <div class="option-button">Temukan
                            Disini</div>
                    </a>
                </div>
                <div class="option-image">
                    <img src="img/industrial.jpg"
                        style="width: 500px; height: 400px; border-top-right-radius: 5px; border-bottom-right-radius: 5px;" />
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
