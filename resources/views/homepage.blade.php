@extends('template.template')

@section('title')
    Dronezone
@endsection

@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    </head>
    <div class="landing-page">
        <div class="video-box">
            <div class="video-container">
                <video class="video" autoplay muted playsinline loop>
                    <source src="img/videoplayback.mp4"/>
                </video>
                <div class="text-container">
                    <label class="header">Sewa Drone di Surabaya <br>Kini Lebih Mudah</label>
                    <h5 class="description">Melalui website kami, anda dapat dengan mudah menelusuri berbagai mitra penyedia sewa drone di Surabaya. Kami berkomitmen untuk menyediakan informasi yang jelas dan akurat sehingga anda dapat mengetahui informasi mitra yang tepat secara umum maupun profesional sesuai dengan kebutuhan anda.</h5>
                    <div class="header-button">
                        <button class="button">Jelajahi Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="option-container">
        <div class="option-box">
            <div class="option-text">
                <label class="option-content">Cari Mitra <br>Dronemu Sekarang!</label>
                <h5 class="option-content-desc">Cari mitra drone untuk menjadi teman perjalanan anda, mengabadikan momen tak terlupakan bersama keluarga, pesta pernikahan, hingga liburan honeymoon. Temukan berbagai macam mitra penyedia jasa drone disekitar anda di Surabaya sekarang.</h5>
                <div class="option-button">Temukan Disini</div>
            </div>
            <div class="option-image">
                <img src="img/wedding.jpg"/>
            </div>
        </div>
        <div class="drone-photo">
            <img src="img/white-drone.png"/>
        </div>
        <div class="option-box-second">
            <div class="option-text-second">
                <label class="option-content-second">Butuh Mitra <br>Drone Profesional?</label>
                <h5 class="option-content-desc-second">Cari mitra persewaan drone untuk kebutuhan profesional anda di Surabaya dengan pilot yang terpercaya, portofolio mitra dan tersertifikasi oleh Dinas Perhubungan. Temukan berbagai macam mitra sesuai lokasi yang anda inginkan di Surabaya sekarang.</h5>
                <div class="option-button-second">Temukan Disini</div>
            </div>
            <div class="option-image">
                <img src="img/industrial.jpg"/>
            </div>
        </div>
    </div>

@endsection
