@extends('layouts.admin')

@section('title')
    Dashboard Admin
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
        })

        function initializeTable() {
            table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('dashboard.index') }}",
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
