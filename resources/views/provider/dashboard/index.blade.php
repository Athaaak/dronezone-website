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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column gap-2">
                            <div>
                                <h5 class="fw-bold">ToyroadDrone</h5>
                                <span>Profesional Pilot</span>
                            </div>
                            <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                                class="rounded-2" />
                            <div class="file-input-wrapper btn btn-sm btn-light border border-1">
                                Upload
                                <input type="file" name="file" class="file-input" />
                            </div>
                            <div>
                                <h5 class="fw-bold">Area Coverage</h5>
                                <select class="form-select" name="district" id="district">
                                </select>
                            </div>
                            <div>
                                <h5 class="fw-bold">Category</h5>
                                <select class="form-select" name="category">
                                    <option value="1">Profesional</option>
                                    <option value="2">Umum</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex flex-column gap-2">
                            <div class="col-md-12">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">Description</span>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">Address</span>
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">Contact</span>
                                    <input class="form-control form-control-sm" name="contact" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">Company Email</span>
                                    <input class="form-control form-control-sm" name="email" />
                                </div>
                            </div>
                            <div class="d-flex align-self-end">
                                <button class="btn btn-small btn-dark rounded-pill px-4">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            fetchDistrict()
        })

        function fetchDistrict() {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/3578.json`)
                .then(response => response.json())
                .then((data) => {
                    data.map((item) => {
                        $('#district').append(`<option id="${item.id}">${item.name}</option>`)
                    })
                });
        }
    </script>
@endsection
