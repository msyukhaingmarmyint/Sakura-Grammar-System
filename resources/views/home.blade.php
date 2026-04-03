@extends('layouts.app')

@section('content')
<style>
    .level-circle {
        width: 100px !important;
        height: 100px !important;
        font-size: 20px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .card-btn {
        background-color: #1A237E;
        color: #fff;
    }

    @media (max-width: 768px) {
        .level-circle {
            width: 80px !important;
            height: 80px !important;
            font-size: 16px !important;
        }

        .quote {
            font-size: 18px;
        }

        .title {
            font-size: 22px;
        }
    }
</style>

<div class="container-fluid">
    <!-- Main Section -->
    <div class="mb-3 d-flex justify-content-center">
        <div class="col-md-8">
            <img src="{{ asset('img/logo-light.png') }}" id="themeLogo" alt="Logo" class="w-100 h-75">
            <h3 class="text-center quote" style="color: #ff7c9d; font-family: 'Noto Sans JP', sans-serif;">
                🌸 Bloom in Japanese, petal by petal 🌸
            </h3>
        </div>
    </div>

    <!-- Level Section -->
    <section class="mb-5 pt-3">
        <div class="mb-3 row justify-content-center">
            <h1 class="fw-bold text-center mb-5 title">Which grammar level are you studying for?</h1>
            @foreach($levels as $index => $level)
            <div class="col-4 col-md-2 d-flex justify-content-center mb-2">
                <a href="{{ route('lesson.byLevel', urlencode($level->name)) }}"
                    class="text-decoration-none"
                    style="width: 100px; height: 100px;">
                    <div class="level-circle rounded-circle text-white d-flex justify-content-center align-items-center"
                        style="background-color: {{ $colors[$index % count($colors)] }}">
                        {{ $level->name }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="mb-5 pt-3">
        <div class="mb-3 row justify-content-center">
            <h1 class="fw-bold text-center mb-5">About</h1>

            <div class="col-md-5 px-5">
                <img src="{{ asset('img/about1.jpg') }}" class="d-block w-100 object-fit-contain rounded-5 mb-4" alt="...">
            </div>

            <div class="col-md-5 px-5">
                <h5>Sakura Grammar is a Japanese grammar learning website designed to help learners understand Japanese in a simple, clear, and practical way.
                    Our goal is to make Japanese grammar easier for students at every level, from beginners who are
                    learning their first particles to advanced learners who want to master complex sentence structures.
                    At Sakura Grammar, we believe that learning a language should be enjoyable and accessible.
                    That is why our lessons are organized step-by-step with clear explanations, example sentences, and practical usage.
                    Each grammar point is explained in a way that helps learners not only understand the rule but also use it
                    naturally in real conversations.
                </h5>
            </div>
        </div>
    </section>


    <!-- JLPT Section -->
    <section id="jlpt" class="mb-5 pt-3">
        <div class="mb-3 row jusitfy-content-center">
            <h1 class="fw-bold text-center mb-5">Information About JLPT</h1>
            <div class="row justify-content-center">
                <div class="col-md-3 mb-4 mx-3">
                    <div class="card bg-white">
                        <img src="{{ asset('img/jlpt1.png') }}" class="card-img-top" style="height: 270px; object-fit: contain; width: 100%;" alt="...">
                        <div class="card-body ">
                            <h4 class="card-title fw-bold">What is the JLPT?</h4>
                            <button type="button" class="btn card-btn float-end mt-3" data-bs-toggle="modal" data-bs-target="#info1">Read More</button>
                        </div>

                        <div class="modal fade" id="info1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fw-bold" id="exampleModalLabel">What is the JLPT?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>The JLPT is composed of 5 different levels, from 1-5 with 5 being the most basic, and 1 being the most advanced.
                                            The content on this website is organized and divided based on these ability levels, so you can easily find lessons specific to your level.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn card-btn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4 me-3">
                    <div class="card bg-white">
                        <img src="{{ asset('img/jlpt2.png') }}" class="card-img-top" style="height: 270px; object-fit: contain; width: 100%;" alt="...">
                        <div class="card-body">
                            <h4 class="card-title fw-bold">What is the CEFR?</h4>
                            <button type="button" class="btn card-btn float-end mt-3" data-bs-toggle="modal" data-bs-target="#info2">Read More</button>
                        </div>

                        <div class="modal fade" id="info2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fw-bold" id="exampleModalLabel">What is the CEFR?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p> The CEFR level corresponding to the total score of each JLPT level.</p>
                                        <ul>
                                            <li> N5, a total score of 80 or higher is indicated as A1level.</li>
                                            <li> N4, a total score of 90 or higher is indicated asA2 level.</li>
                                            <li> N3, a total score of 95 to 103 is indicated as A2 level, and 104 or higher as B1level.</li>
                                            <li> N2, a total score of 90 to 111 is indicated as B1level, and 112 or higher is indicated as B2 level.</li>
                                            <li> N1, a total score of 100 to 141 is indicated as B2 level, and 142 or higher as C1level.</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn card-btn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card bg-white">
                        <img src="{{ asset('img/jlpt3.avif') }}" class="card-img-top" style="height: 270px; object-fit: contain; width: 100%;" alt="...">
                        <div class="card-body">
                            <h4 class="card-title fw-bold title-color">Benefits of JLPT</h4>
                            <button type="button" class="btn card-btn float-end mt-3" data-bs-toggle="modal" data-bs-target="#info3">Read More</button>
                        </div>

                        <div class="modal fade" id="info3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fw-bold" id="exampleModalLabel">Benefits of JLPT</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ol>
                                            <li class="fw-bold">Increased Employed Opportunities</li>
                                            <ul>
                                                <li>English teaching jobs are not too difficult to find in Japan, but if you want to get a job doing anything else, JLPT results are usually a prerequisite to even apply to most jobs.</li>
                                            </ul>

                                            <li class="fw-bold">Increased Salary</li>
                                            <ul>
                                                <li>Typically, the better your Japanese ability is, you will be able to negotiate for a better salary.</li>
                                            </ul>

                                            <li class="fw-bold">Individual Ability Gauge</li>
                                            <ul>
                                                <li>Even if you are studying just for fun, the JLPT is a good assessment to personally track and test your Japanese ability level.</li>
                                            </ul>
                                        </ol>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn card-btn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="pt-3">
        <div class="mb-3 row justify-content-center">
            <h1 class="fw-bold text-center mb-5">Contact</h1>

            <div class="col-md-4 mb-3 ps-5">
                <h3 class="mb-3 fw-bold">Sakura Grammar</h3>
                <p>"We'd love to hear from you. Reach out anytime."</p>
            </div>

            <div class="col-md-4 ps-5 my-2">
                <div class="mb-3">
                    @foreach($levels as $index => $level)
                    <a href="{{ route('lesson.byLevel', urlencode($level->name)) }}" class="text-decoration-none">
                        <span class="me-5 fw-bold"
                            style="color: {{ $colors[$index % count($colors)] }}">
                            {{ $level->name }}
                        </span>
                    </a>
                    @endforeach
                </div>
                <p><i class="fa-solid fa-envelope me-3" style="color: #1A237E;"></i> sakuragrammar@gmail.com</p>
                
            </div>
        </div>

        <div class="p-3 text-center fw-bold" style="color: #ff7c9d;"> Copyright &copy; All rights reserved | This template is made by me</div>
    </section>
</div>
@endsection