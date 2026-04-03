@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p -5">
                <h3 class="text-center text-body mb-4 fw-bold">Register</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-body">Full Name</label>
                        <input id="name" type="text"
                            class="form-control rounded-3"
                            name="name" value="{{ old('name') }}" autofocus>

                        @error('name')
                        <p class="text-danger">{{ $message }}</p >
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-body">Email Address</label>
                        <input id="email" type="email"
                            class="form-control rounded-3"
                            name="email" value="{{ old('email') }}">

                        @error('email')
                        <p class="text-danger">{{ $message }}</p >
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label text-body">Password</label>
                        <input id="password" type="password" class="form-control rounded-3 pe-5" name="password">

                        <span onclick="togglePassword('password','eye1')" style="position:absolute; top:38px; right:15px; cursor:pointer">
                            <i id="eyeIcon" class="fa fa-eye text-body"></i>
                        </span>

                        @error('password')
                        <p class="text-danger">{{ $message }}</p >
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label text-body">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control rounded-3 pe-5" name="password_confirmation">

                        <span onclick="togglePassword('password-confirm','eye2')"
                            style="position:absolute; top:38px; right:15px; cursor:pointer">
                        <i id="eyeIcon" class="fa fa-eye text-body"></i>
                        </span>
                        
                        @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p >
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn text-white rounded-3 py-2" style="background-color : #ff7c9d">
                            Register
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-body">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                        </small>
                    </div>

                </form>
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