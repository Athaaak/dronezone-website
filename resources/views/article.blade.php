@extends('template.template')

@section('title')
Dronezone
@endsection

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
</head>

<div class="feature-container">
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
</div>
@include('template.footer')
@endsection
