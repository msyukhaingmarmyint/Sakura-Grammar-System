@extends('layouts.app')

@section('content')
<style>
    .level-circle {
        width: 100px;
        height: 100px;
        font-size: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .level-circle:hover {
        width: 110px;
        height: 110px;
        transition: all 0.3s ease;
    }

    .card-btn {
        background-color: #1A237E;
        color: #fff;
    }

    .card-btn:hover {
        background-color: rgba(26, 35, 126, 0.5);
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
            <h3 class="text-center quote" style="color: #dd4c70; font-family: 'Noto Sans JP', sans-serif;">
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


    <section id="jlpt" class="mb-5 pt-3">
        <div class="container">
            <h1 class="fw-bold text-center mb-5">Information About JLPT</h1>

            <!-- Cards Grid Row -->
            <div class="row justify-content-center g-4">

                <!-- Card 1: What is JLPT -->
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card bg-white border-dark shadow-sm rounded-4 overflow-hidden border-1 w-100 d-flex flex-column">
                        <img src="{{ asset('img/jlpt1.png') }}" class="card-img-top p-3" style="height: 220px; object-fit: contain; width: 100%;" alt="What is JLPT">

                        <!-- Centered Flex Body Wrapper -->
                        <div class="card-body p-4 d-flex flex-column align-items-center text-center justify-content-between flex-grow-1">
                            <div>
                                <h4 class="card-title fw-bold text-dark mb-2">What is the JLPT?</h4>
                                <p class="small mb-0 ">Learn about the 5 structural language levels of the exam.</p>
                            </div>

                            <!-- Perfectly Centered Action Button -->
                            <div class="pt-4 w-100">
                                <button type="button" class="btn card-btn text-white px-4 fw-medium shadow-sm" data-bs-toggle="modal" data-bs-target="#info1">
                                    Read More
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal 1 -->
                    <div class="modal fade" id="info1" tabindex="-1" aria-labelledby="info1Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow-lg">
                                <div class="modal-header bg-dark text-white rounded-top-4 py-3">
                                    <h5 class="modal-title fw-bold" id="info1Label">What is the JLPT?</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4  text-start">
                                    <p class="mb-0">The JLPT is composed of 5 different levels, from N1 to N5, with N5 being the most basic and N1 being the most advanced. The content on this website is organized and divided based on these ability levels, so you can easily find lessons specific to your level.</p>
                                </div>
                                <div class="modal-footer border-0  pt-0 px-4 pb-4 justify-content-center">
                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: What is CEFR -->
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card bg-white border-dark shadow-sm rounded-4 overflow-hidden border-1 w-100 d-flex flex-column">
                        <img src="{{ asset('img/jlpt2.png') }}" class="card-img-top p-3" style="height: 220px; object-fit: contain; width: 100%;" alt="What is CEFR">

                        <!-- Centered Flex Body Wrapper -->
                        <div class="card-body p-4 d-flex flex-column align-items-center text-center justify-content-between flex-grow-1">
                            <div>
                                <h4 class="card-title fw-bold text-dark mb-2">What is the CEFR?</h4>
                                <p class=" small mb-0">See how JLPT scaling maps to global framework standards.</p>
                            </div>

                            <!-- Perfectly Centered Action Button -->
                            <div class="pt-4 w-100">
                                <button type="button" class="btn card-btn text-white px-4 fw-medium shadow-sm" data-bs-toggle="modal" data-bs-target="#info2">
                                    Read More
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal 2 -->
                    <div class="modal fade" id="info2" tabindex="-1" aria-labelledby="info2Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow-lg">
                                <div class="modal-header bg-dark text-white rounded-top-4 py-3">
                                    <h5 class="modal-title fw-bold" id="info2Label">What is the CEFR?</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4  text-start">
                                    <p class="mb-3 fw-semibold  small">The approximate CEFR level framework mapping corresponding to your minimum passing score criteria:</p>
                                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2 small">
                                        <li><span class="badge bg-secondary me-2">N5</span> Score ≥ 80 is mapped to <strong>A1</strong></li>
                                        <li><span class="badge bg-secondary me-2">N4</span> Score ≥ 90 is mapped to <strong>A2</strong></li>
                                        <li><span class="badge bg-secondary me-2">N3</span> Score 95–103 maps to <strong>A2</strong>, and ≥ 104 to <strong>B1</strong></li>
                                        <li><span class="badge bg-secondary me-2">N2</span> Score 90–111 maps to <strong>B1</strong>, and ≥ 112 to <strong>B2</strong></li>
                                        <li><span class="badge bg-secondary me-2">N1</span> Score 100–141 maps to <strong>B2</strong>, and ≥ 142 to <strong>C1</strong></li>
                                    </ul>
                                </div>
                                <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                                    <button type="button" class="btn btn-secondary px-4 fw-medium" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Benefits of JLPT -->
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card bg-white border-dark shadow-sm rounded-4 overflow-hidden border-1 w-100 d-flex flex-column">
                        <img src="{{ asset('img/jlpt3.avif') }}" class="card-img-top p-3" style="height: 220px; object-fit: contain; width: 100%;" alt="Benefits of JLPT">

                        <!-- Centered Flex Body Wrapper -->
                        <div class="card-body p-4 d-flex flex-column align-items-center text-center justify-content-between flex-grow-1">
                            <div>
                                <h4 class="card-title fw-bold text-dark mb-2">Benefits of JLPT</h4>
                                <p class=" small mb-0">Discover career opportunities and tracking advantages.</p>
                            </div>

                            <!-- Perfectly Centered Action Button -->
                            <div class="pt-4 w-100">
                                <button type="button" class="btn card-btn text-white px-4 fw-medium shadow-sm" data-bs-toggle="modal" data-bs-target="#info3">
                                    Read More
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal 3 -->
                    <div class="modal fade" id="info3" tabindex="-1" aria-labelledby="info3Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow-lg">
                                <div class="modal-header bg-dark  rounded-top-4 py-3">
                                    <h5 class="modal-titlefw-bold" id="info3Label">Benefits of JLPT</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4 text-start">
                                    <ol class="ps-3 mb-0 d-flex flex-column gap-3 small">
                                        <li>
                                            <strong class="d-block mb-1">Increased Employment Opportunities</strong>
                                            <p class=" mb-0">English teaching jobs are common in Japan, but for technical, corporate, or development careers, JLPT certifications are almost always a strict prerequisite to apply.</p>
                                        </li>
                                        <li>
                                            <strong class="d-block mb-1">Increased Salary Negotiation</strong>
                                            <p class="mb-0">Advanced business language competency directly empowers you to negotiate significantly higher base salaries and professional corporate allowances.</p>
                                        </li>
                                        <li>
                                            <strong class="d-block mb-1">Individual Ability Gauge</strong>
                                            <p class="mb-0">Even when studying for personal enjoyment, the structural curriculum serves as an excellent milestone matrix to track your proficiency goals.</p>
                                        </li>
                                    </ol>
                                </div>
                                <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                                    <button type="button" class="btn btn-secondary px-4 " data-bs-dismiss="modal">Close</button>
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

            <div class="col-md-5 ps-5 my-2">
                <div class="mb-3">
                    @foreach($levels as $index => $level)
                    <a href="{{ route('lesson.byLevel', urlencode($level->name)) }}" class="text-decoration-none">
                        <span class="me-4 fw-bold"
                            style="color: {{ $colors[$index % count($colors)] }}">
                            {{ $level->name }}
                        </span>
                    </a>
                    @endforeach
                </div>

                <p>
                    <i class="fa-solid fa-envelope me-3" style="color: #1A237E;"></i>
                    <a href="mailto:khaingkhainglay984@gmail.com" class="text-decoration-none">sakuragrammar@gmail.com</a>
                </p>

            </div>
        </div>

        <div class="p-3 text-center fw-bold" style="color: #dd4c70;">
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                <span>Copyright &copy; All rights reserved</span>
                <span class="d-none d-sm-inline">|</span>
                <span>Developed by GCG students</span>
            </div>
        </div>
    </section>
</div>
@endsection