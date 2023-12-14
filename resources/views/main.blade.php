<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>BiarPro</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://i.postimg.cc/LsZX3FWV/BIARPRO32.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset ('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset ('/css/style.css') }}" rel="stylesheet">
  <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-AlBiBYFC9GXWUjmv"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="https://i.postimg.cc/8cWfX40J/BIARPRO3-LOGO.png" alt="">
        <span>BiarPro</span>

      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Harga Paket</a></li>
          @if (Auth::check() && Auth::user()->id)
          <li><a class="getstarted scrollto" href="/dashboard">Dashboard</a></li>
          @else
          <li><a class="getstarted scrollto" href="{{ route ('login') }}">Login</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
    @yield('hero')

  <main id="main">
    @yield('content')
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="https://i.postimg.cc/8cWfX40J/BIARPRO3-LOGO.png" alt="">
              <span>BiarPro</span>
            </a>
            <p>  BiarPro adalah sebuah inovatif platform revolusioner yang dirancang khusus untuk membantu Anda menghasilkan artikel promosi produk dengan cekatan dan mengesankan.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Paket Harga</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Artikel Promosi</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Banyuwangi<br>
              <strong>Phone:</strong> 082301039197<br>
              <strong>Email:</strong> biarpro2023@gmail.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>BiarPro</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset ('vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset ('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset ('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset ('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset ('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset ('vendor/php-email-form/validate.js') }}"></script>
  

  <!-- Template Main JS File -->
  <script src="{{ asset ('js/main.js') }}"></script>

</body>

</html>