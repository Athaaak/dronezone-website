@extends('layouts.admin')

@section('title')
    Accounts
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
                    </div>
                </div>
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Provider</th>
                            <th>Company</th>
                            <th>Created</th>
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
                ajax: `{{ route('account.datatable') }}`,
                columns: [{
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
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
    </script>
@endsection
