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
            <video class="video" autoplay muted playsinline>
                    <source src="img/videoplayback.mp4"/>
                </video>
                <div class="text-container">
                <label class="header">Sewa Drone <br>Jadi lebih mudah<br> Di Surabaya</label>
                <h5 class="description">Melalui DRONEZONE, anda dapat dengan mudah menelusuri berbagai penyedia sewa drone, membandingkan harga, spesifikasi, dan ulasan pengguna di Surabaya. Kami berkomitmen untuk menyediakan informasi yang jelas dan akurat sehingga anda dapat membuat keputusan yang tepat sesuai dengan kebutuhan anda.</h5>
            </div>
            </div>
        </div>
    </div>

@endsection
