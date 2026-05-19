@extends('layouts.app')

@section('content')

<div class="container">
    <div class="text-center mb-5 position-relative">
        <h1 class="fw-bold" style="color: #ff7c9d;">Bookmark</h1>
        <a href="{{ route('user') }}" class="btn px-4 position-absolute end-0 top-0 rounded-3 text-white shadow-sm" style="background-color: #6c757d;">
            <i class="fa fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="row justify-content-center">
        @if($bookmarks->count() > 0)
        @foreach($bookmarks as $bookmark)
        <div class="card p-3 mb-2 position-relative" style="border-color: #ff7c9d; background-color : #fff">
            <h4>{{$loop->iteration}}. {{ $bookmark->lesson->title ?? 'No title' }}</h4>
            <form action="{{ route('bookmark.destroy', $bookmark->id) }}" method="POST"
                class="position-absolute top-0 end-0 m-3">
                @csrf
                @method('DELETE')

                <button type="submit" style="border: none; background: none;">
                    <i class="bi bi-x" style="font-size: 23px;"></i>
                </button>

            </form>
            <p><span style="font-weight : bold">Structure :</span> {{ $bookmark->lesson->structure }}</p>
            <p><span style="font-weight : bold">Explanation :</span>{{ $bookmark->lesson->explanation }}</p>
            <p><span style="font-weight : bold">Example : </span>{{ $bookmark->lesson->example }}</p>
        </div>
        @endforeach
        @else
        <p>No bookmarks found.</p>
        @endif
    </div>
</div>
</div>
@endsection