<div class="card shadow-sm rounded-4 border-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-danger text-white align-middle m-0">
            <thead class="table-cherry-header text-uppercase small tracking-wider">
                <tr>
                    <th class="ps-4 py-3">User Email</th>
                    <th class="py-3">Requested At</th>
                    <th class="py-3 text-center">Status</th>
                    @if($type === 'pending')
                    <th class="pe-4 py-3 text-end">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($filteredRequests as $request)
                <tr class="hover-row transition">
                    <td class="ps-4 py-3 fw-medium text-secondary">
                        {{ $request->email }}
                    </td>

                    <td class="py-3 text small">
                        {{ $request->created_at ? $request->created_at->diffForHumans() : 'N/A' }}
                    </td>

                    <td class="py-3 text-center">
                        @if($type === 'pending')
                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2 small fw-semibold">Pending</span>
                        @elseif($type === 'accepted')
                        <span class="badge rounded-pill bg-success text-white px-3 py-2 small fw-semibold">Active</span>
                        @else
                        <span class="badge rounded-pill bg-danger text-white px-3 py-2 small fw-semibold">Inactive</span>
                        @endif
                    </td>

                    <!-- Actions (Only for Pending) -->
                    @if($type === 'pending')
                    <td class="pe-4 py-3 text-end">
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-end">

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