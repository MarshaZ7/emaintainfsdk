@extends('layouts.fsdk-user.app')

@section('title', 'FAQ')

@section('content')

<!-- FAQ Hero Section -->
<section id="faq" class="hero section dark-background">
    <img src="{{ asset('user-template/assets/img/hero-bg-2.jpg') }}" alt="e-Maintain@FSDK" class="hero-bg">

    <div class="container">
        <div class="row gy-4 justify-content-center">

            <div class="col-lg-8 text-center d-flex flex-column justify-content-center" data-aos="fade-in">
                <h1>
                    Frequently Asked <br>
                    <span>Questions</span>
                </h1>
                <p>
                    Find answers to common questions about
                    e-Maintain@FSDK and the facility maintenance
                    complaint process.
                </p>

            </div>

        </div>
    </div>

    <!-- Wave -->
    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
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
<!-- /FAQ Hero Section -->


<!-- FAQ Section -->
<section id="faq" class="faq section">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title text-center" data-aos="fade-up">
            <h2>FAQ</h2>
            <div>
                <span>Frequently Asked </span>
                <span class="description-title">Questions</span>
            </div>
            <p class="mt-3">
                Learn more about using e-Maintain@FSDK
                to report and track facility and equipment problems.
            </p>
        </div>

        <!-- General Questions -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <h3 class="mb-4" data-aos="fade-up">
                    <i class="bi bi-info-circle me-2"></i>
                    General Information
                </h3>
                <div class="faq-container" data-aos="fade-up" data-aos-delay="100">

                    <!-- FAQ -->
                    <div class="faq-item faq-active">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            What is e-Maintain@FSDK?
                        </h3>
                        <div class="faq-content">
                            <p>
                                e-Maintain@FSDK is a web-based facility
                                and laboratory maintenance management
                                system developed for the Faculty of Data
                                Science and Computing (FSDK), Universiti
                                Malaysia Kelantan.
                            </p>

                            <p>
                                The system provides a centralized platform
                                for reporting, managing, tracking, and
                                resolving facility and equipment problems.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            Who can use e-Maintain@FSDK?
                        </h3>
                        <div class="faq-content">
                            <p>
                                e-Maintain@FSDK is intended for students,
                                lecturers, and staff of FSDK who need to
                                report facility, laboratory, or equipment
                                problems.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            What is the purpose of this system?
                        </h3>
                        <div class="faq-content">
                            <p>
                                The system is designed to make facility
                                problem reporting more organized,
                                transparent, and easier to track compared
                                with manual reporting methods.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Complaint Questions -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <h3 class="mb-4" data-aos="fade-up">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Complaint Submission
                </h3>
                <div class="faq-container" data-aos="fade-up" data-aos-delay="100">
                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            Do I need to log in before submitting a complaint?
                        </h3>
                        <div class="faq-content">
                            <p>
                                Yes. Users must log in before submitting
                                a complaint. This allows the system to
                                identify the complainant and maintain
                                the complaint history.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            What types of problems can I report?
                        </h3>
                        <div class="faq-content">
                            <p>
                                Users can report problems related to
                                IT equipment, laboratory equipment,
                                facilities, electrical systems,
                                air conditioners, furniture, and
                                other maintenance-related issues
                                within FSDK.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            What information should I provide in a complaint?
                        </h3>
                        <div class="faq-content">
                            <p>
                                Users should provide information such as
                                the problem description, facility or
                                equipment involved, location of the issue,
                                and other relevant details. Supporting
                                evidence may also be provided when required.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Questions -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <h3 class="mb-4" data-aos="fade-up">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    Complaint Status & Maintenance
                </h3>
                <div class="faq-container" data-aos="fade-up" data-aos-delay="100">
                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            Can I track my submitted complaint?
                        </h3>
                        <div class="faq-content">
                            <p>
                                Yes. After logging in, users can access
                                the <strong>My Complaints</strong> page
                                to view their submitted complaints and
                                monitor the progress of each complaint.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            What happens after I submit a complaint?
                        </h3>
                        <div class="faq-content">
                            <p>
                                After submission, the complaint will be
                                reviewed by the IT Admin. Once verified,
                                the complaint can be assigned to a
                                technician for further investigation
                                and maintenance.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            How will I know when my complaint is resolved?
                        </h3>
                        <div class="faq-content">
                            <p>
                                The status of your complaint can be
                                monitored through the My Complaints
                                page. Once the maintenance process has
                                been completed, the complaint status
                                will be updated accordingly.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <!-- FAQ -->
                    <div class="faq-item">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            Can I provide feedback after the issue is resolved?
                        </h3>
                        <div class="faq-content">
                            <p>
                                Yes. After the maintenance process is
                                completed, users can provide feedback
                                and rating based on the resolution
                                of their reported issue.
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
<!-- /FAQ Section -->
@endsection