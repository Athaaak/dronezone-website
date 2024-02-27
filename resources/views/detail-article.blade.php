@extends('template.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/general.css') }}?version={{ time() }}">
    <style>
        .background-wrapper {
            position: relative;
            text-align: center;
            color: white;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .gradient-bottom {
            -webkit-mask-image: -webkit-gradient(linear,
                    left 50%,
                    left bottom,
                    from(rgba(0, 0, 0, 1)),
                    to(rgba(0, 0, 0, 0)));
        }
    </style>
@endsection
@section('content')
    <div class="background-wrapper gradient-bottom">
        <img src="{{ $article->image }}" alt="Snow" style="width:100%;max-height: 300px;
        object-fit: cover;">
    </div>
    <div class="container my-3">
        <div id="provider-content" class="d-flex flex-column gap-2">
            <h1>{{ $article->title }}</h1>
            <small>{{ $article->created_at }} | Admin</small>
            <p>{{ $article->description }}</p>
        </div>
        <nav class="mt-4">
            <ul id="pagination" class="pagination justify-content-center">
            </ul>
        </nav>
    </div>

    @include('template.footer')
@endsection
@section('scripts')
@endsection
