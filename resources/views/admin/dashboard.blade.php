@extends('layouts.app')

@section('content')

<style>
    body{
        background-color: #ffffff;
    }

    .wave-hand {
        display: inline-block;
        transform-origin: 70% 70%;
        animation: wave 1.6s infinite;
    }

    @keyframes wave {
        0% { transform: rotate(0deg); }
        20% { transform: rotate(15deg); }
        40% { transform: rotate(-10deg); }
        60% { transform: rotate(15deg); }
        80% { transform: rotate(-5deg); }
        100% { transform: rotate(0deg); }
    }

    .dashboard-card{
        border-radius:18px;
        background:#ffffff;
        padding:30px;
        text-align:center;
        transition:.25s;
        border:1px solid #ff7c9d;
        box-shadow:0 6px 20px rgba(0,0,0,0.06);
        height:100%;
    }

    .dashboard-card:hover{
        transform:translateY(-8px);
        box-shadow:0 12px 30px rgba(0,0,0,0.12);
    }

    .dashboard-icon{
        font-size:40px;
        margin-bottom:15px;
    }

    .dashboard-title{
        font-weight:600;
        font-size:18px;
        color:#333;
    }

    .welcome-title{
        font-weight:700;
        margin-bottom:40px;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center welcome-title">
                Hello {{ Auth::user()->name }}
                <span class="wave-hand">👋</span>
            </h1>

            <div class="d-flex justify-content-center mb-3">
                <a href="{{route('levels.create')}}" class="btn btn-outline-primary rounded-pill px-4 me-3"><i class="fa-solid fa-plus"></i> Add Level</a>
                <a href="{{route('lessons.create')}}" class="btn btn-outline-danger rounded-pill px-4 me-3"><i class="fa-solid fa-plus"></i> Add Lesson</a>
                <a href="{{route('questions.create')}}" class="btn btn-outline-success rounded-pill px-4 me-3"><i class="fa-solid fa-plus"></i> Add Question</a>
                <a href="{{route('exams.create')}}" class="btn btn-outline-warning rounded-pill px-4 me-3"><i class="fa-solid fa-plus"></i> Add Exam</a>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <a href="{{route('levels.index')}}" class="text-decoration-none">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">📚</div>
                            <div class="dashboard-title">Levels</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{route('lessons.index')}}" class="text-decoration-none">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">📖</div>
                            <div class="dashboard-title">Lessons</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{route('questions.index')}}" class="text-decoration-none">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">❔</div>
                            <div class="dashboard-title">Questions</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{route('exams.index')}}" class="text-decoration-none">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">📝</div>
                            <div class="dashboard-title">Exams</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{route('users.index')}}" class="text-decoration-none">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">👥</div>
                            <div class="dashboard-title">Users</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{route('scores.index')}}" class="text-decoration-none">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">📊</div>
                            <div class="dashboard-title">Certificates</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection