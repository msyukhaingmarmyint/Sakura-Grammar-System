@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body">
                <h3 class="text-center text-body mb-4 fw-bold">{{ __('Reset Password') }}</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label text-body">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control " name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                         @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label text-body">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password">
                        <span onclick="togglePassword('password','icon1')"
                              style="position:absolute; top:38px; right:15px; cursor:pointer;">
                            <i id="icon1" class="fa fa-eye text-body"></i>
                        </span>

                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password-confirm" class="form-label text-body">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        <span onclick="togglePassword('password-confirm','icon2')"
                              style="position:absolute; top:38px; right:15px; cursor:pointer;">
                            <i id="icon2" class="fa fa-eye text-body"></i>
                        </span>

                        @error('password_confirmation')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn text-white rounded-3 py-2" style="background-color: #ff7c9d;">
                            Reset Password
                        </button>
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