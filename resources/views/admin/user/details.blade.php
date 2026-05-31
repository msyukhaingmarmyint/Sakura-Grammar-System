@extends('layouts.app')

@section('content')
<style>
body{
    background:#f5f7fb;
}

.profile-card{
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(15px);
    border-radius:30px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.profile-cover{
    height:140px;
    background:linear-gradient(
        135deg,
        #ff6b9a,
        #ff9eb7,
        #ffd2dd
    );
}

.profile-avatar{
    width:130px;
    height:130px;
    object-fit:cover;
    border-radius:50%;
    border:6px solid #fff;
    margin-top:-65px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.status-badge{
    padding:8px 20px;
    border-radius:50px;
    font-size:.85rem;
    font-weight:600;
}

.status-badge.active{
    background:#e8fff1;
    color:#14ae5c;
}

.status-badge.inactive{
    background:#ffecec;
    color:#dc3545;
}

.info-item{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 0;
    border-bottom:1px solid #f1f1f1;
}

.info-item:last-child{
    border-bottom:none;
}

.info-item i{
    width:35px;
    height:35px;
    border-radius:10px;
    background:#f7f8fb;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#ff6b9a;
}

.dashboard-card{
    position:relative;
    overflow:hidden;
    background:#fff;
    border-radius:28px;
    padding:30px;
    box-shadow:0 15px 40px rgba(0,0,0,.06);
    transition:.3s;
}

.dashboard-card:hover{
    transform:translateY(-8px);
}

.attempts-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:linear-gradient(90deg,#4f46e5,#8b5cf6);
}

.certificate-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:linear-gradient(90deg,#10b981,#34d399);
}

.card-icon{
    width:65px;
    height:65px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
    font-size:24px;
    color:#fff;
}

.attempts-card .card-icon{
    background:linear-gradient(135deg,#4f46e5,#8b5cf6);
}

.certificate-card .card-icon{
    background:linear-gradient(135deg,#10b981,#34d399);
}

.modern-progress{
    height:10px;
    border-radius:50px;
    background:#eef2f7;
    overflow:hidden;
}

.progress-bar{
    border-radius:50px;
}
</style>
<div class="container">
    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">User Details</h1>
    </div>

    <div class="row g-4">

        {{-- Profile Card --}}
        <div class="col-lg-4">
            <div class="profile-card">
                <div class="profile-cover"></div>
                <div class="text-center px-4 pb-4">
                    <img
                        src="{{ $user->profile ? asset($user->profile) : asset('profiles/default.png') }}"
                        class="profile-avatar">
                    <h3 class="fw-bold mb-3">{{ $user->name }}</h3>
                    <span class="status-badge {{ $user->status == 'active' ? 'active' : 'inactive' }}">
                        {{ ucfirst($user->status) }}
                    </span>

                    <div class="mt-4 text-start">

                        <div class="info-item">
                            <i class="fa fa-envelope"></i>
                            <span>{{ $user->email }}</span>
                        </div>

                        <div class="info-item">
                            <i class="fa fa-calendar"></i>
                            <span>{{ $user->created_at->format('d M Y') }}</span>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        {{-- Statistics --}}
        <div class="col-lg-8">

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="dashboard-card attempts-card">
                        <div class="card-icon">
                            <i class="fa fa-chart-line"></i>
                        </div>

                        <h6>Total Attempts</h6>

                        <div class="display-4 fw-bold">
                            {{ $attemptsCount }}
                        </div>

                        <div class="mt-4">
                            @foreach($levelCounts as $level => $count)
                            <div class="mb-3">

                                <div class="d-flex justify-content-between mb-1">
                                    <span>{{ $level }}</span>
                                    <span>{{ $count }}</span>
                                </div>

                                <div class="progress modern-progress">
                                    <div class="progress-bar"
                                         style="width: {{ ($count / 3) * 100 }}%">
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dashboard-card certificate-card">

                        <div class="card-icon">
                            <i class="fa fa-award"></i>
                        </div>

                        <h6>Total Certificates</h6>

                        <div class="display-4 fw-bold">
                            {{ $certificatesCount }}
                        </div>

                        <div class="mt-4">

                            @forelse($certificateLevelCounts as $level => $count)

                            <div class="mb-3">

                                <div class="d-flex justify-content-between mb-1">
                                    <span>{{ $level }}</span>
                                    <span>{{ $count }}</span>
                                </div>

                                <div class="progress modern-progress">
                                    <div
                                        class="progress-bar bg-success"
                                        style="width: {{ ($count / 3) * 100 }}%">
                                    </div>
                                </div>

                            </div>

                            @empty

                            <div class="text-muted">
                                No certificates yet
                            </div>

                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection