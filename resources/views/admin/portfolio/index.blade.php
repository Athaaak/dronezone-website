@extends('layouts.admin')

@section('title')
    Portfolios
@endsection

@section('content')
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Portfolio <b>List</b></h2>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex flex-row align-items-center gap-2">
                                <small class="fw-bold">Sort</small>
                                <select class="form-select" name="district" id="district">
                                    <option disabled selected>Select District</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Company</th>
                            <th>Created</th>
                            <th>Location</th>
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

        $(document).ready(function() {
            initializeTable()
            fetchDistrict()
        })

        $('#district').change(function() {
            reinitializeTable()
        })

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

        function initializeTable() {
            table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: `{{ route('portfolio.admin-datatable') }}?district=${$('#district').val()}`,
                columns: [{
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'email',
                        name: 'email',
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
    </script>
@endsection
