<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <!-- About e-Maintain -->
            <div class="col-lg-5 col-md-6 footer-about">
                <a href="{{ route('user.dashboard') }}"
                   class="logo d-flex align-items-center">
                    <span class="sitename">
                        e-Maintain@FSDK
                    </span>
                </a>
                <p class="mt-3">
                    e-Maintain@FSDK is a web-based facility and
                    laboratory maintenance management system
                    developed for the Faculty of Data Science and
                    Computing (FSDK), Universiti Malaysia Kelantan.
                </p>
                <p>
                    The system allows FSDK users to submit facility
                    and equipment complaints and monitor the progress
                    of their reports.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li>
                        <a href="{{ route('user.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            My Complaints
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Report Issue
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/faq') }}">
                            FAQ
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Account -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>My Account</h4>
                <ul>
                    <li>
                        <a href="#">
                            My Profile
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="border-0 bg-transparent p-0"
                                    style="color: inherit;">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Assistance -->
            <div class="col-lg-3 col-md-12 footer-contact">
                <h4>Need Assistance?</h4>
                <p>
                    If you experience problems with a facility,
                    laboratory equipment, or IT equipment, you can
                    submit a complaint through e-Maintain@FSDK.
                </p>
                <p class="mt-3">
                    <strong>Faculty:</strong>
                    <span>
                        FSDK, Universiti Malaysia Kelantan
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="container copyright text-center mt-4">
        <p>
            © <span>2026</span>
            <strong class="px-1 sitename">
                e-Maintain@FSDK
            </strong>
            <span>All Rights Reserved</span>
        </p>
        <div class="credits">
            Facility & Laboratory Maintenance Management System
        </div>
    </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader"></div>