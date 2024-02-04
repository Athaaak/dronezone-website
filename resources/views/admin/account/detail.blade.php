@extends('layouts.admin')

@section('title')
    Account Detail
@endsection

@section('content')
    <div class="container-lg">
        <div class="card my-5">
            <div class="card-header header-color">
                <h4>Company Inventory</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column gap-2">
                            <div>
                                <h5 class="fw-bold">Company Name</h5>
                                <span>{{ $provider->company_name }}</span>
                            </div>
                            <img src="{{ $provider->photo }}" class="rounded-2" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <h5 class="fw-bold">Area Coverage</h5>
                        <span>{{ $provider->district }}</span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <h5 class="fw-bold">Category</h5>
                        <span>{{ $provider->division }}</span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <h5 class="fw-bold">Date Created</h5>
                        <span>{{ $provider->created_at }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteComponent">Remove
                        Account</button>
                </div>
            </div>
        </div>
    </div>

    @include('components.modal.delete')
@endsection
@section('scripts')
    <script type="text/javascript">
        let provider_id = "{{ $provider->id }}"
        let notyf;

        $(document).ready(function() {
            notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'center',
                    y: 'bottom',
                },
            });
        })

        function formReset() {
            $('#modal-form')[0].reset();
            $('#output').attr('src', '')
        }

        $('#btn-delete').click(function() {
            $(this).html(loader())

            $.ajax({
                url: `{{ url('accounts/${provider_id}') }}`,
                type: "DELETE",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': provider_id,
                },
                success: function(data) {
                    $('#btn-delete').html('Delete')
                    $("[data-dismiss=modal]").trigger({
                        type: "click"
                    });
                    notyf.success(data.message);
                },
                error: function(request, msg, error) {
                    $('#btn-delete').html('Delete')

                }
            });
        })
    </script>
@endsection
