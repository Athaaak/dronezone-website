@extends('layouts.admin')

@section('title')
    Inventory Detail
@endsection

@section('content')
    <div class="container-lg">
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('inventory.index') }}" class="text-dark">
                <i class="fa fa-arrow-left mt-4 fs-2" aria-hidden="true"></i>
            </a>
        @endif
        <div class="card my-4">
            <div class="card-header header-color">
                <h4>Company Inventory</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column gap-2">
                            <div>
                                <h5 class="fw-bold">{{ $provider->company_name ?? '-' }}</h5>
                                <span>{{ $provider->division ?? '-' }}</span>
                            </div>
                            <img src="{{ $provider->photo ?? asset('img/no-image.jpg') }}" class="rounded-2" />
                            <div>
                                <h5 class="fw-bold">Area Coverage</h5>
                                <span>{{ $provider->district ?? '-' }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Address</h5>
                                <span>{{ $provider->address_provider ?? '-' }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Contact</h5>
                                <span>{{ $provider->phone_number ?? '-' }}</span>
                                <span>{{ $provider->provider_email ?? '-' }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Date Created</h5>
                                <span>{{ $provider->user->created_at ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fs-5 fw-bold">Inventory List</span>
                                <button id="btn-add-modal" class="btn btn-sm btn-success px-4" data-toggle="modal"
                                    data-target="#modalForm" onclick="">Add</button>
                            </div>
                            <div id="inventory-content" class="d-flex flex-column gap-2">

                            </div>
                            <nav>
                                <ul id="pagination" class="pagination justify-content-center">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form inventory</h5>
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
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="spesification" class="form-label">Spesification</label>
                            <input type="text" class="form-control" id="spesification" name="spesification"
                                placeholder="Spesification">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="detail_inventory" class="form-label">Detail Inventory</label>
                            <input type="text" class="form-control" id="detail_inventory" name="detail_inventory"
                                placeholder="Detail Inventory">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="special_feature" class="form-label">Special Feature</label>
                            <input type="text" class="form-control" id="special_feature" name="special_feature"
                                placeholder="Special Feature">
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">Description</label>
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
        let provider_id = "{{ $provider->id ?? '-' }}"
        let page = 1;
        let selectedId;
        let notyf;

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        $(document).ready(function() {
            getInventory()

            notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'center',
                    y: 'bottom',
                },
            });
        })

        function getInventory() {
            $('#pagination').html('')
            $('#inventory-content').html(loaderPrimary())
            $.ajax({
                url: `{{ route('inventory.get') }}?provider_id=${provider_id}&page=${page}`,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#inventory-content').html('')
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
                                        <img src="${item.photo}"
                                            class="rounded-2" width="150" />
                                        <div class="d-flex flex-column">
                                            <span>${item.title}</span>
                                            <small>${item.description}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row border-start border-2 pl-3 gap-2">
                                        <i class="fa fa-pencil" data-toggle="modal"
                                        data-target="#modalForm" style="cursor: pointer" onclick="editData('${item.id}')"></i>
                                        <i class="fa fa-trash text-danger" data-toggle="modal"
                                        data-target="#modalDeleteComponent" style="cursor: pointer" onclick="deleteData('${item.id}')"></i>
                                    </div>
                                </div>
                        `
                            $('#inventory-content').append(html)
                        })
                    }
                },
            });
        }

        function prevPage() {
            page--
            getInventory()
        }

        function nextPage() {
            page++
            getInventory()
        }

        function setPage(number) {
            page = number
            getInventory()
        }

        $('#btn-add-modal').click(function() {
            formReset()
        })

        function formReset() {
            $('#modal-form')[0].reset();
            $('#output').attr('src', '')
        }

        function editData(id) {
            selectedId = id
            $('#btn-add').addClass('d-none')
            $('#btn-update').removeClass('d-none')
            $.ajax({
                url: `{{ url('inventory/${id}') }}`,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#title').val(data.title)
                    $('#description').val(data.description)
                    $('#spesification').val(data.spesification)
                    $('#detail_inventory').val(data.detail_inventory)
                    $('#special_feature').val(data.special_feature)
                    $('#output').attr('src', data.photo)
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
            data.append('provider_id', provider_id);

            $.ajax({
                url: "{{ route('inventory.store') }}",
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
                    getInventory()
                }
            });
        })

        $('#btn-update').click(function() {
            $(this).html(loader())
            var data = new FormData($('#modal-form')[0]);
            data.append('_method', 'PUT');

            $.ajax({
                url: `{{ url('inventory/${selectedId}') }}`,
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
                    getInventory()
                }
            });
        })

        $('#btn-delete').click(function() {
            $(this).html(loader())

            $.ajax({
                url: `{{ url('inventory/${selectedId}') }}`,
                type: "DELETE",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': selectedId,
                },
                success: function(data) {
                    $('#btn-delete').html('Delete')
                    $("[data-dismiss=modal]").trigger({
                        type: "click"
                    });
                    notyf.success(data.message);
                    getInventory()
                },
                error: function(request, msg, error) {
                    $('#btn-delete').html('Delete')

                }
            });
        })
    </script>
@endsection
