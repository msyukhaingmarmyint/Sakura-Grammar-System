@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Header Banner -->
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Update User</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name Input Field -->
                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Name</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="name" class="form-control  border-start-0 ps-2" value="{{ old('name', $user->name) }}">
                            </div>
                            @error('name')
                            <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Input Field -->
                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Email Address</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control  border-start-0 ps-2" value="{{ old('email', $user->email) }}">
                            </div>
                            @error('email')
                            <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profile Image -->
                        <div class="mb-3 text-center">
                            <label class="form-label text-body d-block">Profile Image</label>

                            <!-- Profile Preview -->
                            <img id="profilePreview"
                                src="{{ $user->profile? asset($user->profile):asset('profiles/default.png') }}"
                                class="rounded-circle border shadow-sm mb-3"
                                width="120"
                                height="120"
                                style="object-fit: cover;">

                            <!-- Upload Button BELOW image -->
                            <div>
                                <label for="profile" class="btn btn-outline-primary rounded-3 px-4">
                                    <i class="fa fa-upload me-1"></i> Upload Photo
                                </label>

                                <input type="file"
                                    name="profile"
                                    id="profile"
                                    accept="image/*"
                                    onchange="previewProfile(event)"
                                    style="display: none;">
                            </div>

                            @error('profile')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Update User
                            </button>

                            @if($user->role == 'user')
                            <a href="{{ route('user.profile', $user->id) }}" class="btn btn-secondary px-4 rounded-3 fw-medium">Cancel</a>
                            @else
                            <a href="{{ route('users.index') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">Cancel</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function previewProfile(event) {
        const reader = new FileReader();

        reader.onload = function() {
            document.getElementById('profilePreview').src = reader.result;
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection