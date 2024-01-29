@extends('layouts.admin')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <div class="container-lg">
        <div class="card my-5">
            <div class="card-header header-color">
                <h4>Company Portfolio</h4>
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
                            <div>
                                <h5 class="fw-bold">Area Coverage</h5>
                                <span>Dukuh Kupang</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Address</h5>
                                <span>JL. Gubeng Airlangga</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Contact</h5>
                                <span>+6282345678990</span>
                                <span>yourmail@mail.com</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Date Created</h5>
                                <span>Monday, 3 July 2023</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fs-5 fw-bold">Portfolio List</span>
                                <button class="btn btn-sm btn-success px-4">Add</button>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex flex-row justify-content-between bg-gray p-2">
                                    <div class="d-flex flex-row gap-3">
                                        <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                                            class="rounded-2" width="200" />
                                        <div class="d-flex flex-column">
                                            <span>Aerial Shot at Lombok</span>
                                            <small>Aerial Shot at Lombok</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row border-start border-2 pl-3 gap-2">
                                        <i class="fa fa-edit"></i>
                                        <i class="fa fa-trash text-danger"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between bg-gray p-2">
                                    <div class="d-flex flex-row gap-3">
                                        <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                                            class="rounded-2" width="200" />
                                        <div class="d-flex flex-column">
                                            <span>Aerial Shot at Lombok</span>
                                            <small>Aerial Shot at Lombok</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row border-start border-2 pl-3 gap-2">
                                        <i class="fa fa-edit"></i>
                                        <i class="fa fa-trash text-danger"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between bg-gray p-2">
                                    <div class="d-flex flex-row gap-3">
                                        <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                                            class="rounded-2" width="200" />
                                        <div class="d-flex flex-column">
                                            <span>Aerial Shot at Lombok</span>
                                            <small>Aerial Shot at Lombok</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row border-start border-2 pl-3 gap-2">
                                        <i class="fa fa-edit"></i>
                                        <i class="fa fa-trash text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"></script>
@endsection
