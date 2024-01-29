@extends('layouts.admin')

@section('title')
    Dashbiard Admin
@endsection

@section('content')
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Provider <b>List</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#modalForm"
                                id="btn-add-modal"><i class="fa fa-plus"></i> Add
                                New</button>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @elseif($message = Session::get('delete'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <table id="data-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
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

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        $(document).ready(function() {
            initializeTable()

            notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'center',
                    y: 'bottom',
                },
            });
        })

        function initializeTable() {
            table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('articles.index') }}",
                columns: [{
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        }

        function reinitializeTable() {
            $('#data-table').DataTable().clear().destroy()
            initializeTable()
        }

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
                url: `{{ url('admin/articles/${slug}') }}`,
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
                    reinitializeTable()
                }
            });
        })

        $('#btn-update').click(function() {
            $(this).html(loader())
            var data = new FormData($('#modal-form')[0]);
            data.append('_method', 'PUT');

            $.ajax({
                url: `{{ url('/admin/articles/${selectedSlug}') }}`,
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
                    reinitializeTable()
                }
            });
        })

        $('#btn-delete').click(function() {
            $(this).html(loader())

            $.ajax({
                url: `{{ url('admin/articles/${selectedId}') }}`,
                type: "DELETE",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': selectedId,
                },
                success: function(data) {
                    $(this).html('Hapus')
                    $("[data-dismiss=modal]").trigger({
                        type: "click"
                    });
                    notyf.success(data.message);
                    reinitializeTable()
                },
                error: function(request, msg, error) {
                    $(this).html('Hapus')

                }
            });
        })
    </script>
@endsection
