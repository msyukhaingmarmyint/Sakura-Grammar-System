@extends('layouts.app')

@section('content')
<div class="container">
    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Users Requests' List</h1>
    </div>

    <!-- Tab Filter Navigation -->
    <div class="card shadow-sm rounded-4 border-0 overflow-hidden mb-4">
        <div class="bg-light p-2">
            <ul class="nav nav-pills flex-column flex-md-row gap-2" id="requestTabs">
                <li class="nav-item">
                    <a href="{{ route('admin.mailbox', ['status' => 'pending']) }}"
                        class="nav-link fw-semibold rounded-3 py-2 text-center {{ $status === 'pending' ? 'active' : '' }}"
                        style="color: #ff7c9d;">
                        <i class="fa fa-clock me-2"></i>Pending Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mailbox', ['status' => 'accepted']) }}"
                        class="nav-link fw-semibold rounded-3 py-2 text-center {{ $status === 'accepted' ? 'active' : '' }}"
                        style="color: #ff7c9d;">
                        <i class="fa fa-check-circle me-2"></i>Accepted Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mailbox', ['status' => 'rejected']) }}"
                        class="nav-link fw-semibold rounded-3 py-2 text-center {{ $status === 'rejected' ? 'active' : '' }}"
                        style="color: #ff7c9d;">
                        <i class="fa fa-times-circle me-2"></i>Rejected Requests
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="position-relative mt-2">
        @include('admin.partialtable', ['filteredRequests' => $filteredRequests, 'type' => $status])

        <div class="d-flex justify-content-center mt-4">
            {{ $filteredRequests->links() }}
        </div>
    </div>
</div>

<style>
    #requestTabs .nav-link.active {
        background-color: #ff7c9d !important;
        color: white !important;
    }

    #requestTabs .nav-link:not(.active):hover {
        background-color: #fff0f3;
        color: #ff7c9d !important;
    }

    .table-cherry-header {
        background-color: #ff7c9d !important;
        color: white !important;
    }

    .hover-row:hover {
        background-color: #fff9fa;
    }
</style>
@endsection