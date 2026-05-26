@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-4">
                <h3 class="text-center text-body mb-4 fw-bold">Register</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-body">Full Name</label>
                        <input id="name" type="text"
                            class="form-control rounded-3"
                            name="name" value="{{ old('name') }}" autofocus>

                        @error('name')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-body">Email Address</label>
                        <input id="email" type="text"
                            inputmode="email"
                            class="form-control rounded-3 "
                            name="email" value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            oninput="checkGmailValidity(this.value)">

                        <div class="d-flex justify-content-between mt-1">
                            <small id="emailHelpText" class="text-muted "></small>
                        </div>

                        @error('email')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label text-body">Password (Enter at least 8 characters.)</label>
                        <input id="password" type="password" class="form-control rounded-3 pe-5 " name="password" oninput="checkPasswordStrength(this.value)">

                        <span onclick="togglePassword('password','eye1')" style="position:absolute; top:38px; right:15px; cursor:pointer" class="z-3">
                            <i id="eye1" class="fa fa-eye text-muted"></i>
                        </span>

                        <div class="mt-2">
                            <div class="progress" style="height: 6px;">
                                <div id="strengthBar" class="progress-bar transition-base" role="progressbar" style="width: 0%"></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <small id="strengthText" class="text-muted "></small>
                            </div>
                        </div>

                        @error('password')
                        <p class="text-danger small mt-2 fw-medium">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4 position-relative">
                        <label class="form-label text-body">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control rounded-3 pe-5 " name="password_confirmation">

                        <span onclick="togglePassword('password-confirm','eye2')" style="position:absolute; top:38px; right:15px; cursor:pointer" class="z-3">
                            <i id="eye2" class="fa fa-eye text-muted"></i>
                        </span>

                        @error('password_confirmation')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="submitBtn" class="btn text-white rounded-3 py-2" style="background-color : #ff7c9d">
                            Register
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-body">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none " style="color: #ff7c9d;">Login</a>
                        </small>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-base {
        transition: all 0.3s ease-in-out;
    }

    .small-helper-text {
        font-size: 0.75rem;
    }
</style>

<script>
    function checkGmailValidity(email) {
        const helpText = document.getElementById('emailHelpText');

        if (!email) {
            helpText.textContent = 'Must be a valid Gmail account';
            helpText.className = 'text-muted ';
            return;
        }

        // Standard Gmail structural requirements matching criteria
        const gmailRegex = /^[a-zA-Z0-9.]+@gmail\.com$/;

        if (gmailRegex.test(email)) {
            helpText.textContent = 'Valid Gmail format';
            helpText.className = 'text-success ';
        } else {
            helpText.textContent = 'Please enter a valid username@gmail.com address';
            helpText.className = 'text-danger ';
        }
    }

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

    function checkPasswordStrength(password) {
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        let score = 0;

        if (!password) {
            bar.style.width = '0%';


            return;
        }

        if (password.length >= 8) score += 25;
        if (password.length >= 12) score += 15;
        if (/[A-Z]/.test(password)) score += 15;
        if (/[a-z]/.test(password)) score += 15;
        if (/[0-9]/.test(password)) score += 15;
        if (/[^A-Za-z0-9]/.test(password)) score += 15;
        if (score < 40) {
            bar.style.width = '25%';
            bar.className = 'progress-bar bg-danger';
            text.textContent = 'Weak Password';
            text.className = 'text-danger ';
        } else if (score >= 40 && score < 75) {
            bar.style.width = '60%';
            bar.className = 'progress-bar bg-warning';
            text.textContent = 'Medium Strength';
            text.className = 'text-warning ';
        } else {
            bar.style.width = '100%';
            bar.className = 'progress-bar bg-success';
            text.textContent = 'Strong Password';
            text.className = 'text-success ';
        }
    }
</script>
@endsection