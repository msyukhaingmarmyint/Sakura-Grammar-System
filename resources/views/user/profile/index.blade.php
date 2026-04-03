@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card shadow-sm rounded-4 overflow-hidden">
                <div class="bg-dark text-white p-4 position-relative">
                    @if($user->role == 'user')
                    <a href="{{route('user')}}"
                        class="btn btn-sm btn-outline-light position-absolute top-0 end-0 m-3">
                        <i class="fas fa-times"></i>
                    </a>
                    @else
                    <a href="{{route('admin')}}"
                        class="btn btn-sm btn-outline-light position-absolute top-0 end-0 m-3">
                        <i class="fas fa-times"></i>
                    </a>
                    @endif

                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ $user->name }}</h3>
                            <p class="mb-0 text-light opacity-75">User Profile Details</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-lg-5 bg-white">
                    <div class="mb-4">
                        <p class="text-uppercase small fw-semibold mb-3">Personal Information</p>

                        <div class="bg-light rounded-4 p-3 mb-3 border">
                            <label class="small mb-1 d-block">Full Name</label>
                            <div class="fw-semibold fs-5">{{ $user->name }}</div>
                        </div>

                        <div class="bg-light rounded-4 p-3 border">
                            <label class="small mb-1 d-block">Email Address</label>
                            <div class="fw-semibold fs-6">{{ $user->email }}</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center flex-wrap gap-2 pt-3 border-top">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary rounded-pill">Edit</a>
                        <a href="{{ route('password.form') }}" class="btn btn-success rounded-pill">Change Password</a>
                        @if($user->role == 'user')
                        <button class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deactivateModal">Deactivate</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modern Bootstrap Modal --}}
<div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <h4 class="fw-bold mb-2" id="deactivateModalLabel">Deactivate User?</h4>
                <p class="text-muted mb-4">Are you sure you want to deactivate <strong>{{ $user->name }}</strong>? </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light border " data-bs-dismiss="modal">Cancel</button>

                    <form action="{{ route('user.status', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger ">Yes, Deactivate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection