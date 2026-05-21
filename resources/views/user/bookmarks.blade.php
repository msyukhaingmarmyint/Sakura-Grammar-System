@extends('layouts.app')

@section('content')

<div class="container">
    <div class="text-center mb-5 position-relative">
        <a href="{{ route('user') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span> 
        </a>

        <h1 class="fw-bold" style="color: #ff7c9d;">Bookmark</h1>
    </div>

    <div class="row justify-content-center">

        @forelse($bookmarks as $bookmark)

            @php
                $lesson = $bookmark->lesson;
                $level = $lesson?->level;
                $isInactive = !$lesson || $lesson->status !== 'active' || ($level && $level->status !== 'active');
            @endphp

            <div class="card p-3 mb-3 position-relative"
                 style="border-color: #ff7c9d; background-color:#fff;">

                <form action="{{ route('bookmark.destroy', $bookmark->id) }}"
                      method="POST"
                      class="position-absolute top-0 end-0 m-3">
                    @csrf
                    @method('DELETE')

                    <button type="submit" style="border:none; background:none;">
                        <i class="bi bi-x text-dark" style="font-size: 23px;"></i>
                    </button>
                </form>

                <h4>
                    {{ $loop->iteration }}.
                    {{ $lesson->title ?? 'Deleted / Inactive Lesson' }}

                    @if($isInactive)
                        <span class="badge bg-danger ms-2">Inactive</span>
                    @endif
                </h4>

                @if($isInactive)
                    <p class="text-danger">Sorry! This lesson is no available now.</p>
                @else
                    <p><strong>Structure:</strong> {{ $lesson->structure}}</p>
                    <p><strong>Explanation:</strong> {{ $lesson->explanation }}</p>
                    <p><strong>Example:</strong> {{ $lesson->example }}</p>
                @endif
            </div>

        @empty
            <p class="text-center">No bookmarks found.</p>
        @endforelse

    </div>
</div>

@endsection