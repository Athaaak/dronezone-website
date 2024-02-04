@extends('layouts.admin')

@section('title')
    Articles Admin
@endsection

@section('content')
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Articles</h2>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex flex-row justify-content-between">
                        <span class="fs-5 fw-bold"></span>
                        <button id="btn-add-modal" class="btn btn-sm btn-success px-4" data-toggle="modal"
                            data-target="#modalForm" onclick="">Add</button>
                    </div>
                    <div id="article-content" class="d-flex flex-column gap-2">

                    </div>
                    <nav aria-label="Page navigation example">
                        <ul id="pagination" class="pagination justify-content-center">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Articles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" enctype="multipart/form-data" name="modal-form" id="modal-form">
                    @csrf
                    <div class="modal-body">
                        <img id="output" src="" width="30%" />
                        <div class="mb-3 form-group">
                            <label class="form-label" for="customFile">Photos</label>
                            <input accept="image/*" onchange="loadFile(event)" type="file" class="form-control"
                                name="image" id="image" />
                        </div>
                        <div class="mb-3 form-group">
                            <label for="exampleInputPassword1" class="form-label">Article
                                Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Masukkan Judul Artikel">
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">
                                Content</label>
                            <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="button" class="btn btn-primary" id="btn-add">Add</button>
                        <button type="button" class="btn btn-success d-none" id="btn-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.modal.delete')
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

        $('#btn-add-modal').click(function() {
            formReset()
        })

        function formReset() {
            $('#modal-form')[0].reset();
            $('#output').attr('src', '')
        }

        function editData(slug) {
            selectedSlug = slug
            $('#btn-add').addClass('d-none')
            $('#btn-update').removeClass('d-none')
            $.ajax({
                url: `{{ url('articles/${slug}') }}`,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#title').val(data.data.title)
                    $('#description').val(data.data.description)
                    $('#output').attr('src', data.data.image)
                },
            });
            $('#modalTitle').html('Edit')
        }

        function deleteData(id) {
            selectedId = id
        }

        $('#btn-add-modal').click(function() {
            $('#btn-update').addClass('d-none')
            $('#btn-add').removeClass('d-none')
        })

        $('#btn-add').click(function() {
            $(this).html(loader())
            var data = new FormData($('#modal-form')[0]);
            $.ajax({
                url: "{{ route('articles.store') }}",
                type: "POST",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                error: function(xhr, status,
                    error) {
                    alert(xhr.responseText);
                    $('#btn-add').html('Add')
                },
                success: function(response) {
                    formReset()
                    $("[data-dismiss=modal]").trigger({
                        type: "click"
                    });
                    notyf.success(response.message);
                    $('#btn-add').html('Add')
                    getArticle()
                }
            });
        })

        $('#btn-update').click(function() {
            $(this).html(loader())
            var data = new FormData($('#modal-form')[0]);
            data.append('_method', 'PUT');

            $.ajax({
                url: `{{ url('/articles/${selectedSlug}') }}`,
                type: "POST",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                error: function(xhr, status,
                    error) {
                    alert(xhr.responseText);
                    $('#btn-update').html('Update')
                },
                success: function(response) {
                    formReset()
                    $("[data-dismiss=modal]").trigger({
                        type: "click"
                    });
                    notyf.success(response.message);
                    $('#btn-update').html('Update')
                    getArticle()
                }
            });
        })

        $('#btn-delete').click(function() {
            $(this).html(loader())

            $.ajax({
                url: `{{ url('articles/${selectedId}') }}`,
                type: "DELETE",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': selectedId,
                },
                success: function(data) {
                    $('#btn-delete').html('Hapus')
                    $("[data-dismiss=modal]").trigger({
                        type: "click"
                    });
                    notyf.success(data.message);
                    getArticle()
                },
                error: function(request, msg, error) {
                    $('#btn-delete').html('Hapus')

                }
            });
        })

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
                            html = `
                        <div class="d-flex flex-row justify-content-between bg-gray p-2">
                                    <div class="d-flex flex-row gap-3">
                                        <img src="${item.image}"
                                            class="rounded-2" width="150" />
                                        <div class="d-flex flex-column">
                                            <span>${item.title}</span>
                                            <small>${item.description}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row border-start border-2 pl-3 gap-2">
                                        <i class="fa fa-pencil" data-toggle="modal"
                                        data-target="#modalForm" style="cursor: pointer" onclick="editData('${item.slug}')"></i>
                                        <i class="fa fa-trash text-danger" data-toggle="modal"
                                        data-target="#modalDeleteComponent" style="cursor: pointer" onclick="deleteData('${item.id}')"></i>
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
