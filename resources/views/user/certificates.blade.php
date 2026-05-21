@extends('layouts.app')

@section('content')

<style>
    .certificate-card {
        background: linear-gradient(135deg, #ffffff, #f8f9ff);
        border-radius: 20px;
        border: 6px solid #e9ecff;
        padding: 40px;
        transition: .3s;
        position: relative;
    }

    .certificate-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .certificate-title {
        letter-spacing: 4px;
        font-weight: 700;
        color: #444;
    }

    .certificate-brand {
        font-size: 34px;
        font-weight: 800;
        color: #ff7c9d;
    }

    .certificate-name {
        font-size: 30px;
        font-weight: 700;
        margin-top: 10px;
    }

    .certificate-exam {
        font-size: 24px;
        font-weight: 600;
        color: #6c63ff;
    }

    [data-bs-theme="dark"] .certificate-card p,
    .certificate-card .certificate-name {
        color: #000;
    }
</style>

<div class="container">
    <div class="text-center mb-5 position-relative">
        <a href="{{ route('user') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span> 
        </a>
        <h1 class="fw-bold" style="color: #ff7c9d;">Taken Certificates</h1>
    </div>

    <div class="row justify-content-center">

        @foreach($certificates as $certificate)
        <div class="col-md-6 mb-2">

            <div class="certificate-card text-center">

                <div class="certificate-brand">
                    Sakura Grammar
                </div>

                <h4 class="certificate-title mt-3">
                    CERTIFICATE OF
                </h4>

                <h5 class="certificate-title my-3" style="color: #ff7c9d;">
                    "{{$certificate->attempt->exam->title}}"
                </h5>

                <p class="mt-2">
                    This certificate is proudly presented to
                </p>

                <div class="certificate-name">
                    {{ Auth::user()->name }}
                </div>

                <p class="mt-2">
                    for successfully passing the certification exam
                </p>

                <div class="certificate-exam">
                    {{ $certificate->attempt->title }}
                </div>

                <p class="mt-2">
                    Score: <strong>{{ $certificate->attempt->mark }} / 50</strong>
                </p>

                <p>
                    Date :
                    <strong>
                        {{ $certificate->created_at->timezone('Asia/Yangon')->format('d M Y , H:i:s') }}
                    </strong>
                </p>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $certificates->links() }}
        </div>
    </div>
</div>

@endsection