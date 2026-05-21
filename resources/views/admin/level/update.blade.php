@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Edit Level</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('levels.update', $level->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase tracking-wider mb-1">Name</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="name" class="form-control bg-light border-start-0 ps-2" value="{{ old('name', $level->name) }}">
                            </div>
                            @error('name')
                                <p class="text-danger small mt-1 mb-0"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase tracking-wider mb-1">Description</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-align-left"></i>
                                </span>
                                <input type="text" name="description" class="form-control bg-light border-start-0 ps-2" value="{{ old('description', $level->description) }}">
                            </div>
                            @error('description')
                                <p class="text-danger small mt-1 mb-0"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Update
                            </button>
                            <a href="{{ route('levels.index') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection