@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">Add Level</h3>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('levels.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label text-body semibold">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            </div>
                        </div>
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        

                        <div class="mb-3">
                            <label for="" class="form-label text-body">Description</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="description" value="{{old('description')}}"  class="form-control">
                            </div>
                        </div>
                        @error('description')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <button type="submit" class="btn btn-primary rounded-pill px-4">Create</button>
                        <a href="{{route('admin')}}" class="btn btn-danger rounded-pill px-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection