<div class="card shadow-sm rounded-4 border-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-danger text-white align-middle m-0">
            <thead class="table-cherry-header text-uppercase small tracking-wider">
                <tr>
                    <th class="ps-4 py-3">User Email</th>
                    <th class="py-3">Requested At</th>
                    <th class="py-3 text-center">Status</th>
                    @if($type === 'pending')
                    <th class="py-3 text-center">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($filteredRequests as $request)
                <tr class="hover-row transition">
                    <td class="ps-4 py-3 fw-medium ">
                        {{ $request->email }}
                    </td>

                    <td class="py-3 text small">
                        {{ $request->created_at ? $request->created_at->diffForHumans() : 'N/A' }}
                    </td>

                    <td class="py-3 text-center">
                        @if($type === 'pending')
                        <span class="badge   text-dark px-3 py-2 fs-6 fw-bold">Pending</span>
                        @elseif($type === 'accepted')
                        <span class="badge   text-success px-3 py-2 fs-6 fw-bold">Active</span>
                        @else
                        <span class="badge  text-danger px-3 py-2 fs-6 fw-bold">Inactive</span>
                        @endif
                    </td>

                    @if($type === 'pending')
                 <td class="py-3 text-center">
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                            <a href="{{ route('reactivation.accept', $request->id) }}"
                                class="btn btn-sm text-white px-3 rounded-3 shadow-sm"
                                style="background-color: #2ecc71;">
                                <i class="fa fa-check me-1"></i> Accept
                            </a>

                            <a href="{{ route('reactivation.reject', $request->id) }}"
                                class="btn btn-sm text-white px-3 rounded-3 shadow-sm"
                                style="background-color: #e74c3c;">
                                <i class="fa fa-trash me-1"></i> Reject
                            </a>

                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <div class="py-3">
                            <i class="fa fa-folder-open fa-3x mb-3" style="color: #ffccd5;"></i>
                            <p class="mb-0 fw-medium">No {{ $type }} requests found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>