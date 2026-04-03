@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div data-bs-spy="scroll" 
         data-bs-target=".navbar" 
         data-bs-smooth-scroll="true" 
         tabindex="0"
         style="height: 80vh; overflow-y: auto;">
        
        @foreach($levels as $level)
            <div id="level-{{ $level->id }}" class="mb-5">
                <h2 class="text-primary border-bottom pb-3 mb-4">{{ $level->name }}</h2>
                
                @foreach($level->lessons as $lesson)
                    <div id="lesson-{{ $lesson->id }}" class="card mb-4 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">{{ $lesson->title }}</h4>
                        </div>
                        <div class="card-body">
                            @if($lesson->structure)
                                <div class="mb-3">
                                    <h6 class="fw-bold">Structure:</h6>
                                    <p class="text-muted">{{ $lesson->structure }}</p>
                                </div>
                            @endif

                            @if($lesson->explanation)
                                <div class="mb-3">
                                    <h6 class="fw-bold">Explanation:</h6>
                                    <p>{{ $lesson->explanation }}</p>
                                </div>
                            @endif

                            @if($lesson->example)
                                <div class="mb-3">
                                    <h6 class="fw-bold">Example:</h6>
                                    <div class="alert alert-info">
                                        {{ $lesson->example }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>
</div>
@endsection
