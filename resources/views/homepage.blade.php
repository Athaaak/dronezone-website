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
                <source src="img/videoplayback.mp4" />
            </video>
            <div class="text-container">
                <label class="header">Sewa Drone di Surabaya <br>Kini Lebih Mudah</label>
                <h5 class="description">
                    <label class="desc">
                        Melalui website kami, temukan puluhan mitra persewaan drone yang telah tersertifikasi dan
                        terpercaya di Surabaya sesuai kebutuhan anda.
                        <br>Anda juga dapat mengajukan untuk menjadi mitra kami, Gratis.
                    </label>
                </h5>
                <div class="header-button">
                    <a href="{{ route('explore') }}"><button class="button">Sewa Drone
                            Sekarang</button></a>
                    <a href="{{ route('login') }}"><button class="button-mitra">Gabung Mitra
                            Kami</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NOT USED -->
<!-- <div class="option-container">
        <div class="option-box">
            <div class="option-text">
                <label class="option-content">Cari Mitra <br>Dronemu Sekarang!</label>
                <h5 class="option-content-desc">Cari mitra drone untuk menjadi teman perjalanan anda, mengabadikan momen tak terlupakan bersama keluarga, pesta pernikahan, hingga liburan honeymoon. Temukan berbagai macam mitra penyedia jasa drone disekitar anda di Surabaya sekarang.</h5>
                <div class="option-button">Temukan Disini</div>
            </div>
            <div class="option-image">
                <img src="img/wedding.jpg" style="width: 100%; height: auto;"/>
            </div>
        </div>
        <div class="option-box-second">
            <div class="option-text-second">
                <label class="option-content-second">Butuh Mitra <br>Drone Profesional?</label>
                <h5 class="option-content-desc-second">Cari mitra persewaan drone untuk kebutuhan profesional anda di Surabaya dengan pilot yang terpercaya, portofolio mitra dan tersertifikasi oleh Dinas Perhubungan. Temukan berbagai macam mitra sesuai lokasi yang anda inginkan di Surabaya sekarang.</h5>
                <div class="option-button-second">Temukan Disini</div>
            </div>
            <div class="option-image">
                <img src="img/industrial.jpg" style="width: 100%; height: auto;"/>
            </div>
        </div>
    </div> -->

<!-- <div class="feature-container">
    <section class="news-reel">
        <h2 class="section-title">Latest Article</h2>
        <div class="categories">
            <div class="category active">All</div>
            <div class="category">Latest</div>
        </div>
        <div class="news-container">
            <div class="news-item">
                <div class="news-image">
                    <img src="news1.jpg" alt="News 1">
                </div>
                <div class="news-content">
                    <h3 class="news-title">News 1</h3>
                    <p class="news-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a href="#" class="read-more-link" style="color: white;">Read More</a>
                </div>
            </div>
            <div class="news-item">
                <div class="news-image">
                    <img src="news2.jpg" alt="News 2">
                </div>
                <div class="news-content">
                    <h3 class="news-title">News 2</h3>
                    <p class="news-summary">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.</p>
                    <a href="#" class="read-more-link" style="color: white;">Read More</a>
                </div>
            </div>
            <div class="news-item">
                <div class="news-image">
                    <img src="news3.jpg" alt="News 3">
                </div>
                <div class="news-content">
                    <h3 class="news-title">News 3</h3>
                    <p class="news-summary">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                        eu fugiat nulla pariatur.</p>
                    <a href="#" class="read-more-link" style="color: white;">Read More</a>
                </div>
            </div>
        </div>
    </section>
</div> -->
@include('template.footer')
@endsection
