@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card shadow rounded-4 overflow-hidden border-0">

                <!-- Card Header Banner -->
                <div class="bg-dark text-white p-4 position-relative">
                    @if($user->role == 'user')
                    <a href="{{ route('user') }}" class="position-absolute top-0 end-0 m-3 text-light opacity-75 hover-opacity-100 transition-base">
                        <i class="fas fa-times fs-4"></i>
                    </a>
                    @else
                    <a href="{{ route('admin') }}" class="position-absolute top-0 end-0 m-3 text-light opacity-75 hover-opacity-100 transition-base">
                        <i class="fas fa-times fs-4"></i>
                    </a>
                    @endif

                    <div class="d-flex align-items-center gap-3 py-2">

                        <!-- Profile Image -->
                        <img
                            src="{{ $user->profile
            ? asset('storage/' . $user->profile)
            : asset('img/image.png') }}"
                            alt="Profile"
                            width="60"
                            height="60"
                            class="rounded-circle border border-2 border-light shadow-sm"
                            style="object-fit: cover;">

                        <!-- Name + Text -->
                        <div>
                            <h3 class="mb-1 fw-bold text-truncate" style="max-width: 250px;">
                                {{ $user->name }}
                            </h3>

                            <p class="mb-0 text-white small text-uppercase tracking-wider">
                                User Profile Details
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 bg-white">

<<<<<<< HEAD
                   

=======
>>>>>>> 15e8550ccb57204a179306521dc0698052a52398
                    <!-- Information Section -->
                    <div class="mb-4">
                        <h5 class="text-uppercase small fw-bold text-dark tracking-wider mb-3">Personal Information</h5>

                        <!-- Full Name Info Block -->
                        <div class="bg-light rounded-3 p-3 mb-3 border border-light-subtle">
                            <label class="small text-dark mb-1 d-block fw-medium">Full Name</label>
                            <div class="fw-semibold text-dark fs-5">{{ $user->name }}</div>
                        </div>

                        <!-- Email Address Info Block -->
                        <div class="bg-light rounded-3 p-3 border border-light-subtle">
                            <label class="small text-dark mb-1 d-block fw-medium">Email Address</label>
                            <div class="fw-semibold text-dark fs-6 text-break">{{ $user->email }}</div>
                        </div>
                    </div>

                    <!-- Action Buttons Section -->
                    <div class="d-flex justify-content-center gap-2 pt-2">
                        <a href="{{ route('user.edit', $user->id) }}"
                            class="btn btn-primary fw-medium shadow-sm {{ $user->role == 'user' ? 'w-50' : 'w-100' }}">
                            Edit Profile
                        </a>

<<<<<<< HEAD
                        <a href="{{ route('password.form') }}" class="btn text-white px-2 fw-medium shadow-sm" style="background-color: #dd4c70;">
                            Change Password
                        </a>

                        @if($user->role == 'user')
                        <button class="btn btn-danger text-white px-2 fw-medium" data-bs-toggle="modal" data-bs-target="#deactivateModal">
=======
                        @if($user->role == 'user')
                        <button class="btn btn-danger text-white fw-medium w-50"
                            data-bs-toggle="modal"
                            data-bs-target="#deactivateModal">
>>>>>>> 15e8550ccb57204a179306521dc0698052a52398
                            Deactivate
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modern Bootstrap Modal --}}
{{-- Deactivate Account Modal --}}
<div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">

                <div class="text-danger mb-3">
                    <i class="fas fa-exclamation-circle fs-1"></i>
                </div>

                <h4 class="fw-bold mb-2" id="deactivateModalLabel">
                    Confirm Deactivation?
                </h4>

                <p class="text-muted mb-4">
                    Are you sure you want to deactivate
                    <strong>{{ $user->name }}</strong>?
                    This action will restrict access to the application.
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form action="{{ route('user.status', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Yes, Deactivate
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .transition-base {
        transition: all 0.2s ease-in-out;
    }

    .hover-opacity-100:hover {
        opacity: 1 !important;
    }

    .text-dark-light {
        color: rgba(255, 255, 255, 0.7);
    }
</style>
@endsection