@extends('layouts.app')

@section('content')

<style>
    .medal {
        width: 40px;
        height: 40px;
        font-size: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .medal-gold {
        background: gold;
        color: #000;
    }

    .medal-silver {
        background: silver;
        color: #000;
    }

    .medal-bronze {
        background: #cd7f32;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5 position-relative">
        <h1 class="fw-bold">Top Passers</h1>
        <a href="{{ auth()->check() ? (auth()->user()->role == 'admin' ? route('admin') : route('home')) : route('home') }}"
           class="btn btn-secondary position-absolute end-0 top-0">
            Back
        </a>
    </div>

    <div class="row justify-content-center g-4">

        @foreach($topPassersByLevel as $passers)
        @php
        $examTitle = $passers->first()->exam->title;
        $lastMark = 0;
        $rank = 0;
        @endphp

        <div class="col-12 mb-4">
            <h3 class="fw-semibold mb-3" style="color: #5d68ff;">{{ $examTitle }}</h3>

            <div class="row g-3">
                @foreach($passers as $attempt)
                @php
                if ($lastMark !== $attempt->mark) {
                $rank ++;
                }

                $lastMark = $attempt->mark;

                $medal = null;
                if($rank == 1) $medal = '🥇';
                elseif($rank == 2) $medal = '🥈';
                elseif($rank == 3) $medal = '🥉';

                $medalClass = $rank == 1 ? 'medal-gold' : ($rank == 2 ? 'medal-silver' : ($rank == 3 ? 'medal-bronze' : ''));
                @endphp

                <div class="col-md-4">
                    <div class="card shadow-sm bg-white h-100">
                        <div class="card-body d-flex align-items-center gap-3">

                            @if($medal)
                            <div class="medal {{ $medalClass }}">{{ $medal }}</div>
                            @endif


                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $attempt->user->name }}</h6>
                                <small>Score: {{ $attempt->mark }}</small><br>
                                <small>Duration: {{ $attempt->time_taken }} seconds</small>
                            </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection