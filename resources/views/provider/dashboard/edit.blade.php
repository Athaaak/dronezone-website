@extends('layouts.admin')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <div class="container-lg">
        <div class="card my-5">
            <div class="card-header header-color">
                <h4>Company Profile</h4>
            </div>
            <form id="form-data" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="{{ $user->provider->id ?? '' }}" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex flex-column gap-2">
                                <div>
                                    <h5 class="fw-bold">Company Name</h5>
                                    @if ($user->provider == null)
                                        <input class="form-control form-control-sm" name="company_name" />
                                    @else
                                        <span>{{ $user->provider->company_name ?? '-' }}</span>
                                    @endif
                                </div>
                                <img id="output" src="{{ $user->provider->photo ?? asset('img/no-image.jpg') }}"
                                    class="rounded-2" />
                                <div class="file-input-wrapper btn btn-sm btn-light border border-1">
                                    Upload
                                    <input accept="image/*" onchange="loadFile(event)" type="file" name="photo"
                                        class="file-input" />
                                </div>
                                <div>
                                    <h5 class="fw-bold">Area Coverage</h5>
                                    <select class="form-select" name="district" id="district">
                                    </select>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Category</h5>
                                    @if ($user->provider == null)
                                        <select class="form-select" name="division">
                                            <option value="Profesional">
                                                Profesional
                                            </option>
                                            <option value="Umum">
                                                Umum
                                            </option>
                                        </select>
                                    @else
                                        <select class="form-select" name="division">
                                            <option value="Profesional"
                                                {{ $user->provider->division == 'Profesional' ? 'selected' : '' }}>
                                                Profesional
                                            </option>
                                            <option value="Umum"
                                                {{ $user->provider->division == 'Umum' ? 'selected' : '' }}>
                                                Umum
                                            </option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex flex-column gap-2">
                                <div class="col-md-12">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Description</span>
                                        <textarea class="form-control" name="description">{{ $user->provider->description ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Address</span>
                                        <textarea class="form-control" name="address">{{ $user->provider->address_provider ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Contact</span>
                                        <input class="form-control form-control-sm" name="contact"
                                            value="{{ $user->provider->contact ?? '' }}" />
                                    </div>
                                </div>
                                @if ($user->provider == null)
                                    <div class="col-md-5">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">Phone Number</span>
                                            <input class="form-control form-control-sm" name="phone_number" />
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-5">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Company Email</span>
                                        <input class="form-control form-control-sm" name="email"
                                            value="{{ $user->provider->provider_email ?? '' }}" />
                                    </div>
                                </div>
                                <div class="d-flex align-self-end">
                                    <button type="button" class="btn btn-small btn-dark rounded-pill px-4"
                                        id="btn-save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let notyf;
        $(document).ready(function() {
            fetchDistrict()
        })

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        function fetchDistrict() {
            let district = "{{ $user->provider->district ?? '' }}"
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/3578.json`)
                .then(response => response.json())
                .then((data) => {
                    data.map((item) => {
                        $('#district').append(
                            `<option id="${item.id}" ${item.name == district ? 'selected' : ''}>${item.name}</option>`
                        )
                    })
                });
        }

        $(document).ready(function() {
            notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'center',
                    y: 'bottom',
                },
            });
        })

        $('#btn-save').click(function() {
            $(this).html(loader())
            var data = new FormData($('#form-data')[0]);
            data.append('_method', 'PUT');
            var id = $('#id').val()

            $.ajax({
                url: `{{ url('/update-company-profile') }}`,
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
                    $('#btn-save').html('Save')
                },
                success: function(response) {
                    notyf.success(response.message);
                    $('#btn-save').html('Save')
                }
            });
        })
    </script>
@endsection
