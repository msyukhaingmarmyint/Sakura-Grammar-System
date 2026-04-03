@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Update User</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('user.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-body fw-semibold">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-4">
                            <label class="form-label text-body fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Update User
                        </button>

                        @if($user->role == 'user')
                        <a href="{{route('user.profile',$user->id)}}" class="btn btn-danger rounded-pill px-4">Cancle</a>
                        @else
                        <a href="{{route('users.index')}}" class="btn btn-danger rounded-pill px-4">Cancle</a>
                        @endif
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection