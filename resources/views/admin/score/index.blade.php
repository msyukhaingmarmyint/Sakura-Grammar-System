@extends('layouts.app')

@section('content')
<div class="container">
    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Certificates' List</h1>
    </div>

    <div class="row mb-4 g-3 justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('scores.index', array_merge(request()->query(), ['exam' => 'all'])) }}" class="text-decoration-none">
<div class="card stats-card text-center p-3 shadow-sm {{ request('exam', 'all') == 'all' ? 'border-primary' : '' }}">
                        <h6 class="text-body mb-1">Total Certificates</h6>
                    <h2 class="fw-bold text-primary mb-0">{{ $totalCertificates }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="mb-4 d-flex justify-content-center flex-wrap gap-2">
        <a href="{{ route('scores.index', array_merge(request()->query(), ['exam' => null, 'page' => null])) }}"
            class="btn btn-sm level-btn {{ !request('exam') || request('exam') == 'all' ? 'active-level' : '' }}"
            style="--clr: #6c757d; color: #6c757d; border: 2px solid #6c757d;">
            All Certificates
        </a>

        @foreach($examsWithStats as $index => $stat)
        @php
            $color = $colors[$index % count($colors)];
        @endphp
        <a href="{{ route('scores.index', array_merge(request()->query(), ['exam' => $stat->id, 'page' => null])) }}"
            class="btn btn-sm level-btn {{ request('exam') == $stat->id ? 'active-level' : '' }}"
            style="--clr: {{ $color }}; color: {{ $color }}; border: 2px solid {{ $color }};">
            {{ $stat->title }} ({{ $stat->certificates_count }})
        </a>
        @endforeach
    </div>

    <div class="row justify-content-center">
        <div class="col-12 mb-5">
            <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
                <div class="table-responsive">
<table class="table table-danger align-middle m-0">
                            <thead class="table-cherry-header text-uppercase small tracking-wider text-white">
                            <tr>
                                <th class="ps-4 py-3 text-center" style="width: 100px;">ID</th>
                                <th class="py-3">User Name</th>
                                <th class="py-3">Passed Exam</th>
                                <th class="py-3">Taken At</th> <th class="py-3">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($certificates as $certificate)
                            @php
                                $rowClass = $certificate->attempt?->user ? 'row-active-bg' : 'row-inactive-bg';
                            @endphp
                            <tr class="hover-row transition {{ $rowClass }}">
                                <td class="ps-4 py-3 text-center">
                                    <span class="d-inline-flex align-items-center justify-content-center fw-bold rounded-circle text-white shadow-sm"
                                        style="background-color: #ff7c9d; width: 28px; height: 28px; font-size: 0.85rem;">
                                        {{ ($certificates->currentPage() - 1) * $certificates->perPage() + $loop->iteration }}
                                    </span>
                                </td>
                                <td class="py-3 fw-semibold">
                                    {{ $certificate->attempt?->user?->name ?? 'Deleted User' }}
                                </td>
                                <td class="py-3">
                                    {{ $certificate->attempt?->exam?->title ?? 'Unknown Exam' }}
                                </td>
                                <td class="py-3">
                                    {{ $certificate->created_at ? $certificate->created_at->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td class="py-3">
                                    <span class="badge text-dark fs-6 fw-bold py-2">
{{ $certificate->attempt?->mark ?? '0' }} / 50
                                       </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No certificates.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $certificates->links('components.paginations') }}
            </div>
        </div>
    </div>
</div>

<style>
    .table-cherry-header {
        background-color: #ff7c9d !important;
        border-bottom: none !important;
        border-top: none !important;
    }

   .table.table-danger thead th,
    .table.table-danger thead tr {
        border-bottom: 1px solid rgb(0, 0, 0) !important;
        border-color: rgba(0, 0, 0, 0.25) !important;
        --bs-table-border-color: rgb(0, 0, 0) !important;
    }

    .hover-row:hover {
        background-color: var(--bs-hover-bg, #fff9fa) !important;
    }

    .row-active-bg {
        background-color: rgba(25, 135, 84, 0.01);
    }

    .row-inactive-bg {
        background-color: rgba(220, 53, 69, 0.02);
    }

    .stats-card {
        border-radius: 15px;
        border-color: #000;
        color: white;
        transition: 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 124, 157, 0.1);
    }

    .level-btn {
        transition: all 0.2s ease;
    }

    .level-btn:hover {
        background-color: var(--clr) !important;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .active-level {
        background-color: var(--clr) !important;
        color: #fff !important;
    }

    .font-mono {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }

    .transition {
        transition: all 0.15s ease-in-out;
    }

    [data-bs-theme="dark"] .d-flex p,
    .d-flex small {
        color: #000 !important;
    }

    [data-bs-theme="dark"] .stats-card {
        border-color: #fff !important;
    }
</style>
@endsection