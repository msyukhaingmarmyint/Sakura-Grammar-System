@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" >
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-5">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                
                <h3 class="text-center text-body mb-4 fw-bold">Reset Password</h3>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-body">{{ __('Email Address') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn text-white rounded-3 py-2" style="background-color: #ff7c9d;">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection