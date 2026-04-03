@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Edit Level Form</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{route('levels.update',$level->id)}}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="" class="form-label text-body semibold">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="name" class="form-control" value="{{$level->name}}">
                            </div>
                        </div>
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="form-label text-body semibold">Description</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="description" class="form-control" value="{{$level->description}}">
                            </div>
                        </div>
                        @error('description')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        
                        <button type="submit" class="btn btn-primary rounded-pill px-4 mt-3">Update</button>

                        <a href="{{route('levels.index')}}" class="btn btn-danger rounded-pill px-4 mt-3">Cancle</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection