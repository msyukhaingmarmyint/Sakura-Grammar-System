@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Edit Exam Form</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{route('exams.update',$exam->id)}}" method="post">
                        @csrf
                        @method('put')
                        <label for="" class="form-label text-body">Title</label>
                        <input type="text" name="title" class="form-control" value="{{$exam->title}}"> <br>
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <label for="" class="form-label text-body">Pass Mark</label>
                        <input type="number" name="pass_mark" class="form-control" value="{{$exam->pass_mark}}"> <br>
                        @error('pass_mark')
                        <p class="text-danger">{{$message}}</p>
                        @enderror


                        <label for="" class="form-label text-body">Level Name</label>
                        <select name="level_id" class="form-control">
                            <option value="{{$exam->level->id}}">{{$exam->level->name}}</option>
                            @foreach($levels as $l)
                            <option value="{{ $l->id }}">{{ $l->name }}</option>
                            @endforeach
                        </select>
                        @error('level_id')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror

                        <button type="submit" class="btn btn-primary rounded-pill px-4 mt-3">Update</button>

                        <a href="{{route('exams.index')}}" class="btn btn-danger rounded-pill px-4 mt-3">Cancle</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection