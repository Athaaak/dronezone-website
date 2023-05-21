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

        </div>
        <video class="video" controls height="auto" width="auto">
            <source src="img/videoplayback.mp4"/>
        </video>
    </div>

@endsection
