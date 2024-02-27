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
            <div id="article-content" class="d-flex flex-column gap-2">

            </div>
            <nav>
                <ul id="pagination" class="pagination justify-content-center">
                </ul>
            </nav>
        </div>
    </section>
</div>
@include('template.footer')
@endsection

@section('scripts')
    <script type="text/javascript">
        let table;
        let selectedId;
        let notyf;
        let selectedSlug;
        let page = 1;

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        $(document).ready(function() {
            getArticle()

            notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'center',
                    y: 'bottom',
                },
            });
        })

        function deleteData(id) {
            selectedId = id
        }

        function getArticle() {
            $('#pagination').html('')
            $('#article-content').html(loaderPrimary())
            $.ajax({
                url: `{{ route('articles.get') }}?page=${page}`,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#article-content').html('')
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
                            console.log(item)
                            html = `
                            <div class="d-flex flex-row justify-content-between bg-gray p-3">
                            <div class="d-flex flex-row gap-3">
                                <img src="${item.image}" class="rounded-2" width="250"
                                    style="object-fit: cover" />
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">${item.title}</span>
                                    <small>${item.description}</small>
                                    <div class="row mt-4">
                                        <div class="col-md-8">
                                            <div class="d-flex flex-column gap-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('provider.detail') }}?id=${item.user_id}" class="btn btn-warning btn-sm">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                            $('#article-content').append(html)
                        })
                    }
                },
            });
        }

        function prevPage() {
            page--
            getArticle()
        }

        function nextPage() {
            page++
            getArticle()
        }

        function setPage(number) {
            page = number
            getArticle()
        }
    </script>
@endsection
