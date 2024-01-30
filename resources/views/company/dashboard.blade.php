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
                                <h5 class="fw-bold">{{ $user->name }}</h5>
                                <span>{{ $user->provider->division ?? '-' }}</span>
                            </div>
                            <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                                class="rounded-2" />
                            <div>
                                <h5 class="fw-bold">Area Coverage</h5>
                                <span>{{ $user->provider->district ?? '-' }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Address</h5>
                                <span>{{ $user->provider->address_provider ?? '-' }}</span>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="fw-bold">Contact</h5>
                                <span>{{ $user->provider->phone_number ?? '-' }}</span>
                                <span>{{ $user->email ?? '-' }}</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Date Created</h5>
                                <span>{{ $user->created_at ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-self-end">
                                <i class="fa fa-edit fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="fw-bold">Description</h5>
                                <span>{{ $user->provider->description ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column border border-2 mt-4 pl-4">
                            <div class="d-flex align-self-end">
                                <i class="fa fa-edit fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="fw-bold">Portfolio</h5>
                                <div class="d-flex flex-row gap-3 overflow-scroll">
                                    @forelse ($user->provider->portfolio as $key => $item)
                                        @if ($key < 5)
                                            <div class="d-flex flex-column">
                                                <img src="{{ $item->photo }}" class="rounded-2" width="130" />
                                                <span>{{ $item->title }}</span>
                                            </div>
                                        @endif
                                    @empty
                                        <span>Porfolio not found</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column border border-2 pl-4">
                            <div class="d-flex align-self-end">
                                <i class="fa fa-edit fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="fw-bold">Inventory</h5>
                                <div class="d-flex flex-row gap-3 overflow-scroll">
                                    @forelse ($user->provider->inventory as $key => $item)
                                        @if ($key < 5)
                                            <div class="d-flex flex-column">
                                                <img src="{{ $item->photo }}" class="rounded-2" width="130" />
                                                <span>{{ $item->title }}</span>
                                            </div>
                                        @endif
                                    @empty
                                        <span>Inventory not found</span>
                                    @endforelse
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
