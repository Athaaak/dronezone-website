@extends('layouts.admin')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <div class="container-lg">
        <div class="card my-5">
            <div class="card-header header-color">
                <h4>Company Portfolio</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column gap-2">
                            <div>
                                <h5 class="fw-bold">{{ $provider->company_name }}</h5>
                                <span>{{ $provider->division }}</span>
                            </div>
                            <img src="{{ $provider->photo }}" class="rounded-2" />
                            <div>
                                <h5 class="fw-bold">Area Coverage</h5>
                                <span>{{ $provider->district }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Address</h5>
                                <span>{{ $provider->address_provider }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Contact</h5>
                                <span>{{ $provider->phone_number }}</span>
                                <span>{{ $provider->provider_email }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Date Created</h5>
                                <span>{{ $provider->user->created_at }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fs-5 fw-bold">Portfolio List</span>
                                <button class="btn btn-sm btn-success px-4">Add</button>
                            </div>
                            <div id="portfolio-content" class="d-flex flex-column gap-2">

                            </div>
                            <nav aria-label="Page navigation example">
                                <ul id="pagination" class="pagination justify-content-center">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let provider_id = "{{ $provider->id }}"
        let page = 1;
        $(document).ready(function() {
            getPortfolio()
        })

        function getPortfolio() {
            $('#pagination').html('')
            $('#portfolio-content').html(loaderPrimary())
            $.ajax({
                url: `{{ route('portfolio.get') }}?provider_id=${provider_id}&page=${page}`,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#portfolio-content').html('')
                    let pagination = data.links

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
                        <div class="d-flex flex-row justify-content-between bg-gray p-2">
                                    <div class="d-flex flex-row gap-3">
                                        <img src="${item.photo}"
                                            class="rounded-2" width="150" />
                                        <div class="d-flex flex-column">
                                            <span>${item.title}</span>
                                            <small>${item.description}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row border-start border-2 pl-3 gap-2">
                                        <i class="fa fa-edit"></i>
                                        <i class="fa fa-trash text-danger"></i>
                                    </div>
                                </div>
                        `
                        $('#portfolio-content').append(html)
                    })
                },
            });
        }

        function prevPage() {
            page--
            getPortfolio()
        }

        function nextPage() {
            page++
            getPortfolio()
        }

        function setPage(number) {
            console.log(number)
            page = number
            getPortfolio()
        }
    </script>
@endsection
