<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">e-Maintain@FSDK</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}#hero">Home</a></li>
          <li><a href="{{ url('/') }}#about">About</a></li>
          <li><a href="{{ url('/') }}#how-it-works">How It Works</a></li>
          <li><a href="{{ url('faq') }}#faq">FAQ</a></li>
          <li><a href="{{ url('report-issue') }}#report-hero">Report Issue</a></li>          
          <li>
            <a href="{{ route('user.login') }}" class="login-btn">
                <i class="bi bi-person"></i>
                <span>Login</span>
            </a>
        </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>