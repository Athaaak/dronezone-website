@extends('template.template')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/professional.css') }}">
    <title>Travel Website</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="header-logo">DRONEZONE</h1>
                <h1 class="header-text">Cari Vendor Dronemu Sekarang!</h1>
            </div>
            <div class="feature-block">
                <div class="feature">
                    <select class="dropdown">
                        <option value="" disabled selected>Lokasi</option>
                        <option value="destination1">Destination 1</option>
                        <option value="destination2">Destination 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="feature">
                    <select class="dropdown">
                        <option value="" disabled selected>Range Harga</option>
                        <option value="range1">Range 1</option>
                        <option value="range2">Range 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="feature">
                    <div class="search-container">
                        <input type="text" class="search-bar" placeholder="Cari..">
                        <button class="search-button">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>

@include('template.footer')
@endsection
