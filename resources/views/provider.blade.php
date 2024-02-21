@extends('template.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/general.css') }}?version={{ time() }}">
@endsection
@section('content')
    <header class="header-background">
        <div class="header-content">
            <div class="header-left">
                <h1 class="header-logo">DRONEZONE</h1>
                <h1 class="header-text">Cari Vendor Dronemu Sekarang!</h1>
            </div>
            <div class="feature-block">
                <div class="feature">
                    <select id="district" class="form-select">
                        <option value="" selected>Semua Lokasi</option>
                    </select>
                </div>
                <div class="feature">
                    <select id="division" class="form-select">
                        <option value="" selected>Semua</option>
                        <option value="Profesional">Profesional</option>
                        <option value="Umum">Umum</option>
                    </select>
                </div>
                <div class="feature">
                    <div class="search-container">
                        <input id="search" type="text" class="search-bar shadow-none" placeholder="Cari..">
                        <button id="btn-search" class="btn btn-success btn-sm">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-3">
        <div id="provider-content" class="d-flex flex-column gap-2 align-items-center">

        </div>
        <nav class="mt-4">
            <ul id="pagination" class="pagination justify-content-center">
            </ul>
        </nav>
    </div>

    @include('template.footer')
@endsection
@section('scripts')
    <script>
        let page = 1;

        function fetchDistrict() {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/3578.json`)
                .then(response => response.json())
                .then((data) => {
                    data.map((item) => {
                        $('#district').append(
                            `<option id="${item.id}">${item.name}</option>`
                        )
                    })
                });
        }

        $(document).ready(function() {
            fetchDistrict()
            getProvider()
        })

        $('#district').change(function() {
            getProvider()
        })

        $('#division').change(function() {
            getProvider()
        })

        $('#btn-search').click(function() {
            getProvider()
        })

        function getProvider() {
            $('#pagination').html('')
            $('#provider-content').html(loaderPrimary())

            let district = $('#district').val()
            let division = $('#division').val()
            let search = $('#search').val()

            $.ajax({
                url: `{{ route('provider.get') }}?page=${page}&district=${district}&division=${division}&search=${search}`,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#provider-content').html('')
                    let pagination = data.links

                    if (data.data.length > 0) {
                        pagination.map((item) => {
                            let html = ``;

                            if (item.active == true) {
                                html = `<li class="page-item active" aria-current="page">
                            <span class="page-link">${item.label}</span>
                            </li>`
                            } else {
                                html =
                                    `<li class="page-item"><a class="page-link" href="#" onclick="setPage(${item.label})">${item.label}</a></li>`
                            }

                            if (item.label.includes('Previous')) {
                                if (item.active == false) {
                                    html =
                                        `<li class="page-item ${item.url == null ? 'disabled' : ''}" ${item.url != null ? `onclick="prevPage()"` : ''}>
                                        <a class="page-link" href="#">Previous</a>
                                    </li>`
                                }
                            }

                            if (item.label.includes('Next')) {
                                if (item.active == false) {
                                    html =
                                        `<li class="page-item ${item.url == null ? 'disabled' : ''}" ${item.url != null ? `onclick="nextPage()"` : ''}><a class="page-link" href="#">Next</a></li>`
                                }
                            }

                            $('#pagination').append(html)
                        })

                        let html = ''
                        data.data.map(item => {
                            html = `
                            <div class="d-flex flex-row justify-content-between bg-gray p-3">
                            <div class="d-flex flex-row gap-3">
                                <img src="${item.photo}" class="rounded-2" width="250"
                                    style="object-fit: cover" />
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">${item.company_name}</span>
                                    <small>${item.description}</small>
                                    <div class="row mt-4">
                                        <div class="col-md-8">
                                            <div class="d-flex flex-column gap-4">
                                                <div class="row">
                                                    <div class="col-md-4 d-flex flex-column">
                                                        <span>Category</span>
                                                        <span class="fw-light fs-6">${item.division}</span>
                                                    </div>
                                                    <div class="col-md-8 d-flex flex-column">
                                                        <span>Contact</span>
                                                        <span class="fw-light fs-6">${item.contact}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 d-flex flex-column">
                                                        <span>Area Coverage</span>
                                                        <span class="fw-light fs-6">${item.district}</span>
                                                    </div>
                                                    <div class="col-md-8 d-flex flex-column">
                                                        <span>Address</span>
                                                        <span class="fw-light fs-6">${item.address_provider}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-warning btn-sm">View More</button>
                                        <button class="btn btn-secondary btn-sm">Contact</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                            $('#provider-content').append(html)
                        })
                    } else {
                        $('#provider-content').html(`
                            <div class="d-flex flex-column align-items-center">
                                <img src="{{ asset('img/notfound.jpg') }}" width="350" />
                                <span class="fw-bold">Provider not found</span>
                                <span>Make sure you have searched for the data provider.</span>
                            </div>
                        `)
                    }
                },
            });
        }

        function prevPage() {
            page--
            getProvider()
        }

        function nextPage() {
            page++
            getProvider()
        }

        function setPage(number) {
            page = number
            getProvider()
        }
    </script>
@endsection
