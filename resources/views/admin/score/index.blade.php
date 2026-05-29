@extends('layouts.app')

@section('content')

<style>
    .user-card {
        border: 2px solid #ff7c9d;
        background-color: #fff;
        transition: all 0.2s ease;
        border-radius: 15px;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stats-card {
        border-radius: 15px;
        border-color: #000;
        color: white;
        transition: 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    [data-bs-theme="dark"] .d-flex p,
    .d-flex small {
        color: #000 !important;
    }

    [data-bs-theme="dark"] .stats-card {
        border-color: #fff !important;
    }
</style>

<div class="container">
    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Certificates' List</h1>
    </div>

    <div class="row mb-4 g-3 justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', ['exam' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Certificates</h6>
                    <h2 class="fw-bold text-primary">{{ $totalCertificates }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', ['exam' => '1']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">N5 Certificates</h6>
                    <h2 class="fw-bold text-success">{{ $n5Certificates }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', ['exam' => '2']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">N4 Certificates</h6>
                    <h2 class="fw-bold text-danger">{{ $n4Certificates }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', ['exam' => '3']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">N3 Certificates</h6>
                    <h2 class="fw-bold text-info">{{ $n3Certificates }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', ['exam' => '4']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">N2 Certificates</h6>
                    <h2 class="fw-bold text-warning">{{ $n2Certificates }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', ['exam' => '5']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">N1 Certificates</h6>
                    <h2 class="fw-bold text-body">{{ $n1Certificates }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3">
            @forelse($certificates as $certificate)
            <div class="col-6 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body user-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold">User Name : {{ $certificate->attempt?->user?->name ?? 'Deleted User' }}</h5>
                                <p class="mb-1">Passed Exam : {{ $certificate->attempt?->exam?->title ?? 'Unknown Exam' }}</p>
                                <p class="mb-1">Score : {{ $certificate->attempt?->mark ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted mt-4">No certificates available.</p>
            @endforelse
            <div class="d-flex justify-content-end mt-4">
                {{ $certificates->links('components.paginations') }}
            </div>
        </div>
    </div>
</div>
@endsection