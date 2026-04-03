@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">Add Exam</h3>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label text-body semibold">Title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control">
                            </div>
                        </div>
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        

                        <div class="mb-3">
                            <label for="" class="form-label text-body">Pass Mark</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="pass_mark" value="{{old('pass_mark')}}"  class="form-control">
                            </div>
                        </div>
                        @error('pass_mark')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="form-label text-body semibold">Level</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <select name="level_id" class="form-control">
                                    <option value="">---Select Level---</option>
                                    @foreach($levels as $l)
                                    <option value="{{ $l->id }}"
                                        {{ (string) old('level_id', $lesson->level_id ?? '') === (string) $l->id ? 'selected' : '' }}>
                                        {{ $l->name }}
                                    </option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>
                        @error('level_id')
                        <p class="text-danger">
                            {{$message}}
                        </p>
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