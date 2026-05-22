@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Change Password</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @csrf

                        {{-- Current Password --}}
                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">
                                Current Password
                            </label>

                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-lock"></i>
                                </span>

                                <input
                                    id="current_password"
                                    type="password"
                                    name="current_password"
                                    value="{{ old('current_password') }}"
                                    class="form-control border-start-0 ps-2"
                                    placeholder="Enter current password"
                                >

                                <span class="input-group-text bg-light border-start-0"
                                    onclick="togglePassword('current_password','eyeIcon1')"
                                    style="cursor:pointer;">
                                    <i id="eyeIcon1" class="fa fa-eye text-dark"></i>
                                </span>
                            </div>

                            @error('current_password')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">
                                New Password
                            </label>

                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-key"></i>
                                </span>

                                <input
                                    id="new_password"
                                    type="password"
                                    name="new_password"
                                    class="form-control border-start-0 ps-2"
                                    placeholder="Enter new password"
                                >

                                <span class="input-group-text bg-light border-start-0"
                                    onclick="togglePassword('new_password','eyeIcon2')"
                                    style="cursor:pointer;">
                                    <i id="eyeIcon2" class="fa fa-eye text-dark"></i>
                                </span>
                            </div>

                            @error('new_password')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">
                                Confirm Password
                            </label>

                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>

                                <input
                                    id="new_password_confirmation"
                                    type="password"
                                    name="new_password_confirmation"
                                    class="form-control border-start-0 ps-2"
                                    placeholder="Confirm new password"
                                >

                                <span class="input-group-text bg-light border-start-0"
                                    onclick="togglePassword('new_password_confirmation','eyeIcon3')"
                                    style="cursor:pointer;">
                                    <i id="eyeIcon3" class="fa fa-eye text-dark"></i>
                                </span>
                            </div>

                            @error('new_password_confirmation')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit"
                                class="btn text-white px-4 rounded-3 fw-medium shadow-sm"
                                style="background-color: #dd4c70;">
                                Update Password
                            </button>

                            @if(Auth::user()->role == 'user')
                                <a href="{{ route('user.profile', Auth::user()->id) }}"
                                    class="btn btn-secondary px-4 rounded-3 fw-medium">
                                    Cancel
                                </a>
                            @else
                                <a href="{{ route('users.index') }}"
                                    class="btn btn-secondary px-4 rounded-3 fw-medium">
                                    Cancel
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            field.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection