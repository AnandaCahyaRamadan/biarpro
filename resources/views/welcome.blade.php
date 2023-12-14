@extends('main')
  @section('hero')
  <section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Bikin artikel promosi mudah dan cepat dengan BiarPro</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">Kami siap membantu anda kapanpun dan dimanapun</h2>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="{{ route ('login') }}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Get Started</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="img/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>
  </section><!-- End Hero -->
  @endsection
  @section('content')
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class=" d-flex flex-column justify-content-center" data-aos="zoom-out" data-aos-delay="200">
            <div class="content">
              <h3>BiarPro itu apa sih?</h3>
              <h2>BiarPro (Bikin Artikel Promosi).</h2>
              <p>
                BiarPro adalah sebuah inovatif platform revolusioner yang dirancang khusus untuk membantu Anda menghasilkan artikel promosi produk dengan cekatan dan mengesankan. Dengan memanfaatkan kecanggihan platform ini, Anda dapat dengan mudah menciptakan beberapa artikel yang orisinal dan menarik dalam satu klik saja, tanpa harus khawatir tentang isu plagiasi atau penjiplakan konten.
              </p>
            </div>
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Keunggulan Kami</h2>
          <p>Kenapa Anda Harus Memilih Kami</p>
        </header>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="img/values-1.png" class="img-fluid" alt="">
              <h3>Biaya Langganan Terjangkau</h3>
              <p>Cukup hanya dengan 100.000, anda dapat menikmati layanan tahunan kami.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="img/values-2.png" class="img-fluid" alt="">
              <h3>Cepat dan Akurat</h3>
              <p>Layanan yang cepat memudahkan anda untuk membuat artikel tanpa batasan.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="img/values-3.png" class="img-fluid" alt="">
              <h3>Satu Klik Untuk Beberapa Artikel.</h3>
              <p>Dengan satu kali klik anda dapat membuat beberapa artikel.</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container align-items-stretch" data-aos="fade-up">
        <header class="section-header">
          <h2>Harga</h2>
          <p>Cek Harga Kami</p>
        </header>
        <div class="row gy-4 justify-content-center" data-aos="fade-left">
          @foreach($paket as $row)
          <div class="col-lg-4 col-md-12" data-aos="zoom-in" data-aos-delay="100">
            <div class="box d-flex flex-column h-100">
              @if($row->promo == 1)
              <span class="featured">Promo</span>
              @endif
              <h3 style="color: #ff0071;">{{ $row->nama_paket }}</h3>
              <div class="price"><sup>RP.</sup>{{ $row->harga }}<span> /Tahun</span></div>
              <img src="{{ asset('storage/'. $row->image) }}" alt="gambar_artikel" class="img-fluid">
              <ul>
                <li>{!! $row->deskripsi !!}</li>
              </ul>
              <a href="{{ route('checkout', ['id' => Crypt::encryptString($row->id)]) }}" class="btn-buy mt-auto">Buy Now</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endsection
