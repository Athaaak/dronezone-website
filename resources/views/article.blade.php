@extends('template.template')

@section('title')
    Dronezone
@endsection

@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/article.css') }}?version={{ time() }}">
    </head>

    <div class="feature-container">
        <section class="news-reel">
            <h2 class="section-title">Latest Article</h2>
            <div class="categories">
                <div id="filter-all" class="category active">All</div>
                <div id="filter-latest" class="category">Latest</div>
            </div>
            <div class="news-container">
                <div id="article-content" class="d-flex gap-2" style="max-width: 1500px;
                flex-flow: wrap;">

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
        let filter = "";

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

        $('#filter-all').click(function() {
            filter = "all"

            if ($(this).hasClass('active')) {
                $(this).removeClass('active')
                filter = ""
                getArticle()
            } else {
                $(this).addClass('active')
                $('#filter-latest').removeClass('active')
                getArticle()
            }
        })

        $('#filter-latest').click(function() {
            filter = "latest"

            if ($(this).hasClass('active')) {
                $(this).removeClass('active')
                filter = ""
                getArticle()
            } else {
                $(this).addClass('active')
                $('#filter-all').removeClass('active')
                getArticle()
            }
        })

        function deleteData(id) {
            selectedId = id
        }

        function getArticle() {
            $('#pagination').html('')
            $('#article-content').html(loaderPrimary())
            $.ajax({
                url: `{{ route('articles.get') }}?page=${page}&filter=${filter}`,
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
                            html = `
                                <a class="card" href="{{ url('article') }}/${item.slug}" style="text-decoration: none; color: black; width: 450px    ">
                                    <div class="d-flex flex-column align-items-center p-2">
                                            <img src="${item.image}" class="rounded-2 p-2" width="250"
                                        style="object-fit: cover;max-width: 250px;" />
                                        </div>
                                        <div class="d-flex flex-column p-2">
                                            <span class="fw-bold">${item.title}</span>
                                            <small>${formatDate(item.created_at)} | Uploaded by Admin</small>
                                        </div>
                                </a>
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

        function formatDate(date) {
            const timestamp = new Date(date);

            const year = timestamp.getUTCFullYear();
            const month = (timestamp.getUTCMonth() + 1).toString().padStart(2, '0');
            const day = timestamp.getUTCDate().toString().padStart(2, '0');
            const hours = timestamp.getUTCHours().toString().padStart(2, '0');
            const minutes = timestamp.getUTCMinutes().toString().padStart(2, '0');
            const seconds = timestamp.getUTCSeconds().toString().padStart(2, '0');

            const formattedTimestamp = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

            return formattedTimestamp
        }
    </script>
@endsection
