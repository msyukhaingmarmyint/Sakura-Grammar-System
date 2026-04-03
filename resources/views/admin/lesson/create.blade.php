@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">Add Lesson</h3>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('lessons.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="" class="form-label text-body semibold">Lesson Title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control">
                            </div>
                        </div>
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror


                        <div class="row mb-3">
                            <label for="" class="form-label text-body semibold">Structure</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="structure" value="{{old('structure')}}" class="form-control">
                            </div>
                        </div>
                        @error('structure')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="row mb-3">
                            <label for="" class="form-label text-body semibold">Explanation</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="explanation" value="{{old('explanation')}}" class="form-control">
                            </div>
                        </div>
                        @error('explanation')
                        <p class="text-danger">{{$message}}</p>
                        @enderror


                        <div class="row mb-3">
                            <label for="" class="form-label text-body semibold">Example</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-angle-right"></i></span>
                                <input type="text" name="example" value="{{old('example')}}" class="form-control">
                            </div>
                        </div>
                        @error('example')
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