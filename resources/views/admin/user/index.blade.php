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

    [data-bs-theme="dark"] .d-flex p, .d-flex small {
            color: #000 !important;
    }

    [data-bs-theme="dark"] .stats-card {
            border-color: #fff !important;
    }
</style>

<div class="container">
    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span> 
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Users' List</h1>
    </div>

    <div class="row mb-4 g-3 d-flex justify-content-center">
        <div class="col-md-2">
            <a href="{{ route('users.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Users</h6>
                    <h2 class="fw-bold text-primary">{{ $totalUsers }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('users.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Active Users</h6>
                    <h2 class="fw-bold text-success">{{ $activeUsers }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('users.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Users</h6>
                    <h2 class="fw-bold text-danger">{{ $inactiveUsers }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3">
            @forelse($users as $user)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body user-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold">{{ $user->name }}</h5>
                                <p class="text-muted mb-1">{{ $user->email }}</p>
                                <small class="text-secondary">User ID : {{ $user->id }}</small>
                            </div>

                            <div>
                                @if($user->status == 'active')
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            @if($user->status == 'inactive')
                            <form action="{{ route('users.status',$user->id) }}" method="POST" class="d-inline ms-2">
                                @csrf
                                <button class="btn btn-sm btn-success rounded-pill px-4">Activate</button>
                            </form>

                            <form action="#" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button 
                                    type="button"
                                    class="btn btn-sm btn-danger rounded-pill px-4 ms-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-user-id="{{ $user->id }}"
                                    data-user-name="{{ $user->name }}">
                                    Delete
                                </button>
                            </form>
                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty 
            <p class="text-center text-muted mt-4">No users available.</p> 
            @endforelse

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
                    Are you sure you want to delete <strong id="modalUserName"></strong>?
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>

                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; 
        var userId = button.getAttribute('data-user-id');
        var userName = button.getAttribute('data-user-name');
        document.getElementById('modalUserName').textContent = userName;
        var form = document.getElementById('deleteUserForm');
        form.action = '/user/delete/' + userId; 
    });
</script>

@endsection