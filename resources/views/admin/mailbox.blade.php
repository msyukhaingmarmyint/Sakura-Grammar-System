@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 row justify-content-center">
        <div class="position-relative mb-5">
            <h1 class="fw-bold text-center justify-content-center m-0" style="color: #ff7c9d;">Reactivation Requests</h1>
        
        <a href="{{ route('admin') }}" class="btn px-4 position-absolute end-0 top-0 rounded-3 text-white shadow-sm" style="background-color: #6c757d;">
            <i class="fa fa-arrow-left me-2"></i>Back
        </a>
        </div>

    </div>

    <div class="card shadow-sm rounded-4 border-0 overflow-hidden mb-4">
        <div class="bg-white p-2">
            <ul class="nav nav-pills nav-justified" id="requestTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold rounded-3 py-2" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" style="color: #ff7c9d;">
                        <i class="fa fa-clock me-2"></i>Pending Requests
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold rounded-3 py-2" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted" type="button" role="tab" style="color: #495057;">
                        <i class="fa fa-check-circle me-2"></i>Accepted Accounts
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold rounded-3 py-2" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" style="color: #495057;">
                        <i class="fa fa-times-circle me-2"></i>Rejected Requests
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tab Content Panes -->
    <div class="tab-content" id="requestTabsContent">

        <div class="tab-pane fade show active" id="pending" role="tabpanel">
            @include('admin.partialtable', ['filteredRequests' => $requests->where('status', 'pending'), 'type' => 'pending'])
        </div>

        <div class="tab-pane fade" id="accepted" role="tabpanel">
            @include('admin.partialtable', ['filteredRequests' => $requests->where('status', 'accepted'), 'type' => 'accepted'])
        </div>

        <div class="tab-pane fade" id="rejected" role="tabpanel">
            @include('admin.partialtable', ['filteredRequests' => $requests->where('status', 'rejected'), 'type' => 'rejected'])
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