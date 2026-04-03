@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Edit Lesson Form</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{route('lessons.update',$lesson->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="" class="fform-label text-body semibold">Title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="title" class="form-control" value="{{$lesson->title}}">
                            </div>
                        </div>
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="fform-label text-body semibold">Structure</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="structure" class="form-control" value="{{$lesson->structure}}">
                            </div>
                        </div>
                        @error('structure')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="fform-label text-body semibold">Explanation</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="explanation" class="form-control" value="{{$lesson->explanation}}">
                            </div>
                        </div>
                        @error('explanation')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="fform-label text-body semibold">Example</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="example" class="form-control" value="{{$lesson->example}}">
                            </div>
                        </div>
                        @error('example')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="fform-label text-body semibold">Level Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <select name="level_id" class="form-control">
                                    <option value="{{$lesson->level->id}}">{{$lesson->level->name}}</option>
                                    @foreach($levels as $l)
                                    <option value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('level_id')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror

                        <button type="submit" class="btn btn-primary rounded-pill px-4 mt-3">Update</button>

                        <a href="{{route('lessons.index')}}" class="btn btn-danger rounded-pill px-4 mt-3">Cancle</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection