@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="position-relative mb-5">
        <h1 class="fw-bold text-center">Reactivation Requests</h1>
        <a href="{{ route('admin') }}" class="btn btn-secondary position-absolute end-0 top-0">Back</a>
    </div>

    <div class="row mb-4 g-3 d-flex justify-content-center">

    @foreach($requests as $request)
        <div class="card p-3 mb-3">
            <h5>{{ $request->email }}</h5>

            <p>
                Status:
                <strong>{{ $request->status }}</strong>
            </p>

            @if($request->status == 'pending')
            <div>
                <a href="{{ route('reactivation.accept', $request->id) }}"
                   class="btn btn-success text-decoration-none">
                    Accept
                </a>

                <a href="{{ route('reactivation.reject', $request->id) }}"
                   class="btn btn-danger text-decoration-none">
                    Reject
                </a>
            </div>
            @endif

        </div>

    @endforeach

</div>

@endsection