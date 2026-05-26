@extends('layouts.app')

@section('content')
<div class="container">

    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Users' List</h1>
    </div>

    <div class="row mb-4 g-3 justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('users.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Users</h6>
                    <h2 class="fw-bold text-primary m-0">{{ $totalUsers }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('users.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class=" text-body">Active Users</h6>
                    <h2 class="fw-bold text-success m-0">{{ $activeUsers }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('users.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Users</h6>
                    <h2 class="fw-bold text-danger m-0">{{ $inactiveUsers }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mx-auto mb-5">
            <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-danger align-middle m-0">
                        <thead class="table-cherry-header text-uppercase small tracking-wider text-white">
                            <tr>
                                <th class="ps-4 py-3 text-center" style="width: 100px;">ID</th>
                                <th class="py-3">User Name</th>
                                <th class="py-3">Email Address</th>
                                <th class="py-3 text-center" style="width: 140px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            @php
                            $rowClass = $user->status == 'active' ? 'row-active-bg' : 'row-inactive-bg';
                            @endphp
                            <tr class="hover-row transition {{ $rowClass }}">
                                <td class="ps-4 py-3 text-center">
                                    <span class="d-inline-flex align-items-center justify-content-center fw-bold rounded-circle text-white shadow-sm"
                                        style="background-color: #ff7c9d; width: 28px; height: 28px; font-size: 0.85rem;">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </span>
                                </td>
                                <td class="py-3 fw-semibold">
                                    {{ $user->name }}
                                </td>
                                <td class="py-3">
                                    {{ $user->email }}
                                </td>
                                <td class="py-3 text-center">
                                    @if($user->status == 'active')
                                    <span class="badge text-success fs-6 fw-bold px-3 py-2">Active</span>
                                    @else
                                    <span class="badge text-danger fs-6 fw-bold px-3 py-2">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No users available matching this folder setup directory.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $users->links('components.paginations') }}
            </div>
        </div>
    </div>
</div>

<style>
    .table-cherry-header {
        background-color: #ff7c9d !important;
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