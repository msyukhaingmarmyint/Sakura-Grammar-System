@extends('layouts.app')

@section('content')

<div class="container">
    <div class="position-relative mb-4">
        <a href="{{ auth()->check() ? (auth()->user()->role == 'admin' ? route('admin') : route('home')) : route('home') }}"
           class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span> 
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Top Passers</h1>
    </div>

    <div class="row">
        @foreach($topPassersByLevel as $passers)
        @php
        $examTitle = $passers->first()->exam->title;
        $lastMark = 0;
        $rank = 0;
        @endphp

        <!-- Exam Level Section -->
        <div class="col-12 mb-5">
            <h3 class="fw-bold mb-3 d-flex align-items-center" style="color: #dd4c70;">
                <i class="fa fa-graduation-cap me-2 small"></i> {{ $examTitle }}
            </h3>

            <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
                <div class="table-responsive" >
                    <table class="table table-danger align-middle m-0">
                        <thead class="table-cherry-header text-uppercase small tracking-wider text-white">
                            <tr>
                                <th class="ps-4 py-3 text-center" style="width: 100px;">Rank</th>
                                <th class="py-3">Student Name</th>
                                <th class="py-3 text-center">Score</th>
                                <th class="pe-4 py-3 text-end">Time Taken</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($passers as $attempt)
                            @php
                            if ($lastMark !== $attempt->mark) {
                            $rank++;
                            }
                            $lastMark = $attempt->mark;

                            $medal = null;
                            if($rank == 1) $medal = '🥇';
                            elseif($rank == 2) $medal = '🥈';
                            elseif($rank == 3) $medal = '🥉';

                            $rowClass = $rank == 1 ? 'rank-gold-bg' : ($rank == 2 ? 'rank-silver-bg' : ($rank == 3 ? 'rank-bronze-bg' : ''));
                            @endphp

                            <tr class="hover-row transition {{ $rowClass }}">
                                <td class="ps-4 py-3 text-center fw-bold">
                                    @if($medal)
                                    <span class="fs-4 d-block">{{ $medal }}</span>
                                    @else
                                    <span class="text-muted small px-2 py-1 rounded bg-light border">#{{ $rank }}</span>
                                    @endif
                                </td>
                                <td class="py-3 fw-semibold ">
                                    {{ $attempt->user->name }}
                                </td>

                                <td class="py-3 text-center">
                                    {{ $attempt->mark }} points

                                </td>

                                <td class="pe-4 py-3 text-end small font-mono">
                                    
                                    {{ $attempt->time_taken }}s
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .table-cherry-header {
        background-color: #ff7c9d !important;
    }

    .hover-row:hover {
        background-color: #fff9fa !important;
    }

    .rank-gold-bg {
        background-color: rgba(255, 215, 0, 0.04);
    }

    .rank-silver-bg {
        background-color: rgba(192, 192, 192, 0.03);
    }

    .rank-bronze-bg {
        background-color: rgba(205, 127, 50, 0.02);
    }

    .font-mono {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }

    .transition {
        transition: background-color 0.15s ease-in-out;
    }
</style>
@endsection