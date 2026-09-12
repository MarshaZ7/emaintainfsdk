@extends('layouts.user.app')

@section('title', 'Report Issue')

@section('content')

<!-- Report Issue Hero -->
<section id="report-hero" class="hero section dark-background">
    <img src="{{ asset('user-template/assets/img/hero-bg-2.jpg') }}" alt="Report Issue" class="hero-bg">

    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-8 text-center d-flex flex-column justify-content-center"
                 data-aos="fade-in">

                <h1>
                    Report a <br>
                    <span>Facility Issue</span>
                </h1>

                <p>
                    Help us maintain a better learning environment
                    by reporting facility and equipment problems
                    within FSDK.
                </p>

            </div>

        </div>

    </div>

    <!-- Wave -->
    <svg class="hero-waves"
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 24 150 28"
         preserveAspectRatio="none">

        <defs>
            <path id="wave-path"
                  d="M-160 44c30 0 58-18 88-18s58 18 88 18
                  58-18 88-18 58 18 88 18 v44h-352z">
            </path>
        </defs>

        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>

        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>

        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>

    </svg>

</section>
<!-- /Report Issue Hero -->


<!-- Login Required Section -->
<section id="login-required" class="section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="text-center"
                     data-aos="fade-up">

                    <div class="mb-4">

                        <i class="bi bi-person-lock"
                           style="font-size: 70px;">
                        </i>

                    </div>

                    <h2>Login Required</h2>

                    <p class="mt-3">
                        You need to log in before submitting a
                        facility or equipment complaint.
                    </p>

                    <p>
                        Logging in allows e-Maintain@FSDK to identify
                        your account, record your complaint, and help
                        you track its progress until the issue is resolved.
                    </p>

                    <div class="mt-4">

                        <a href=""
                           class="btn btn-primary">

                            <i class="bi bi-person-fill me-2"></i>

                            Login to Report an Issue

                        </a>

                    </div>

                    <div class="mt-3">

                        <a href="">
                            <i class="bi bi-arrow-left me-1"></i>
                            Back to Home
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- /Login Required Section -->


<!-- What You Can Report -->
<section id="report-info"
         class="section light-background">

    <div class="container">

        <div class="section-title text-center"
             data-aos="fade-up">

            <h2>Before You Report</h2>

            <div>
                <span>What You Can </span>
                <span class="description-title">Report</span>
            </div>

        </div>


        <div class="row gy-4">

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up">

                <div class="icon-box text-center">

                    <i class="bi bi-pc-display-horizontal"></i>

                    <h3>IT Equipment</h3>

                    <p>
                        Computers, monitors, network equipment,
                        printers, and other IT-related equipment.
                    </p>

                </div>

            </div>


            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <div class="icon-box text-center">

                    <i class="bi bi-motherboard"></i>

                    <h3>Laboratory Equipment</h3>

                    <p>
                        Equipment and facilities used in
                        laboratories and learning activities.
                    </p>

                </div>

            </div>


            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <div class="icon-box text-center">

                    <i class="bi bi-building"></i>

                    <h3>Facilities</h3>

                    <p>
                        Building facilities, furniture,
                        electrical systems, air conditioning,
                        and other supporting facilities.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- /What You Can Report -->

@endsection