@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4">
                <div class="card-header bg-dark py-3 text-white">
                    <h3 class="mb-0 text-center">Change Password</h3>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('user.password.update') }}">
                        @csrf

                        <div class="mb-3 position-relative">
                            <label class="form-label text-body fw-semibold">Current Password</label>
                            <input id="current_password" type="password" name="current_password" value="{{ old('current_password') }}" class="form-control">
                            <span onclick="togglePassword('current_password','eyeIcon1')"
                              style="position:absolute; top:38px; right:15px; cursor:pointer;">
                            <i id="eyeIcon1" class="fa fa-eye text-body"></i>
                        </span>
                        </div>

                        @error('current_password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        
                        <div class="mb-3 position-relative">
                            <label class="form-label text-body fw-semibold">New Password</label>
                            <input id="new_password" type="password" name="new_password" class="form-control">
                            <span onclick="togglePassword('new_password','eyeIcon2')"
                              style="position:absolute; top:38px; right:15px; cursor:pointer;">
                            <i id="eyeIcon2" class="fa fa-eye text-body"></i>
                        </span>
                        </div>
                        @error('new_password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3 position-relative">
                            <label class="form-label text-body fw-semibold">Confirm Password</label>
                            <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="form-control">
                            <span onclick="togglePassword('new_password_confirmation','eyeIcon3')"
                              style="position:absolute; top:38px; right:15px; cursor:pointer;">
                            <i id="eyeIcon3" class="fa fa-eye text-body"></i>
                        </span>
                        </div>
                        @error('new_password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <button class="btn btn-primary rounded-pill px-4">Update Password</button>

                        @if(Auth::user()->role == 'user')
                        <a href="{{route('user.profile',Auth::user()->id)}}" class="btn btn-danger rounded-pill px-4">Cancle</a>
                        @else
                        <a href="{{route('users.index')}}" class="btn btn-danger rounded-pill px-4">Cancle</a>
                        @endif
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

