@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-4">
                <h3 class="text-center text-body mb-4 fw-bold">Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-body">Email Address</label>
                        <input id="email" type="text"
                            class="form-control rounded-3"
                            name="email" value="{{ old('email') }}" autofocus>

                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label text-body">Password</label>
                        <input id="password" type="password"
                            class="form-control rounded-3 pe-5"
                            name="password">

                        <span onclick="togglePassword()"
                            style="position:absolute; top:38px; right:15px; cursor:pointer;">
                            <i id="eyeIcon" class="fa fa-eye text-body"></i>
                        </span>

                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn text-white rounded-3 py-2" style="background-color: #ff7c9d;">
                            Login
                        </button>
                    </div>

                    <div class="text-center">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                            Forgot Password?
                        </a>
                        @endif
                    </div>

                    <div class="text-center">
                        <small class="text-body">
                            Don't you have an account yet?
                            <a href="{{ route('register') }}" class="text-decoration-none"  style="color: #ff7c9d;">Register</a>
                        </small>
                    </div>
                </form>

                @if(session('inactive_email'))
                    <div class="text-center mt-3">
                        <form method="POST" action="{{ route('reactivation.request') }}">
                            @csrf
                            <input type="hidden"name="email" value="{{ session('inactive_email') }}">

                            <button type="submit" class="btn text-white rounded-3 w-100 py-2" style="background-color:#1A237E;">
                                Reactivate Account
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById("password");
        const icon = document.getElementById("eyeIcon");

        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection