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
                        <div class="col-sm-6">
                            <h2>Provider <b>List</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="status" value="all" checked="checked"> All
                                </label>
                                <label class="btn btn-success">
                                    <input type="radio" name="status" value="active"> Active
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="status" value="inactive"> Inactive
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="status" value="expired"> Expired
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Domain</th>
                            <th>Created&nbsp;On</th>
                            <th>Status</th>
                            <th>Server&nbsp;Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
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
                ajax: "{{ route('dashboard.index') }}",
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
