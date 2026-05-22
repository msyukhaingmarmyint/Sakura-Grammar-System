@extends('layouts.app')

@section('content')

<div class="container">

    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>

        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Users' List</h1>
    </div>

    <div class="row mb-3 g-3 d-flex justify-content-center">
        <div class="col-md-2">
            <a href="{{ route('users.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Users</h6>
                    <h2 class="fw-bold text-primary m-0">{{ $totalUsers }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('users.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class=" text-body">Active Users</h6>
                    <h2 class="fw-bold text-success m-0">{{ $activeUsers }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('users.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Users</h6>
                    <h2 class="fw-bold text-danger m-0">{{ $inactiveUsers }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-5">
            <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-danger align-middle m-0">
                        <thead class="table-cherry-header text-uppercase small tracking-wider text-white">
                            <tr>
                                <th class="ps-4 py-3 text-center" style="width: 100px;">ID</th>
                                <th class="py-3">User Name</th>
                                <th class="py-3">Email Address</th>
                                <th class="py-3 text-center" style="width: 140px;">Status</th>
                                <th class="pe-4 py-3 text-center" style="width: 240px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            @php
                            $rowClass = $user->status == 'active' ? 'row-active-bg' : 'row-inactive-bg';
                            @endphp
                            <tr class="hover-row transition {{ $rowClass }}">
                                <td class="ps-4 py-3 text-center fw-bold font-mono text-secondary">
                                    #{{ $loop->iteration }}
                                </td>
                                <td class="py-3 fw-semibold">
                                    {{ $user->name }}
                                </td>
                                <td class="py-3 ">
                                    {{ $user->email }}
                                </td>
                                <td class="py-3 text-center">
                                    @if($user->status == 'active')
                                    <span class="badge text-success fs-6 fw-bold px-3 py-2">Active</span>
                                    @else
                                    <span class="badge text-danger fs-6 fw-bold px-3 py-2">Inactive</span>
                                    @endif
                                </td>
                                <td class="py-3 text-center">
                                    @if($user->status == 'inactive')
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('users.status', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success  px-3 shadow-sm">Activate</button>
                                        </form>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}">
                                            Delete
                                        </button>
                                    </div>
                                    @else
                                    <span class="text-muted small fw-bold">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No users available matching this folder setup directory.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <h4 class="fw-bold mb-2" id="deleteModalLabel">Delete User?</h4>
                <p class="text-muted mb-4">
                    Are you sure you want to delete <strong id="modalUserName"></strong>? This processing sequence cannot be reversed.
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light border  px-4" data-bs-dismiss="modal">Cancel</button>

                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger px-4 shadow-sm">Yes, Delete</button>
                    </form>
                </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var userId = button.getAttribute('data-user-id');
                var userName = button.getAttribute('data-user-name');

                document.getElementById('modalUserName').textContent = userName;
                document.getElementById('deleteUserForm').action = '/user/delete/' + userId;
            });
        }
    });
</script>

@endsection