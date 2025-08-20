@extends('layout.masterlayout')
@section('content')

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <h1 data-aos="fade-up">About Us</h1>
      <p class="lead" data-aos="fade-up" data-aos-delay="200">
        We create meaningful digital experiences with innovation and passion.
      </p>
    </div>
  </section>

  <!-- About Text -->
  <section class="about-text">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6" data-aos="fade-right">
          <img src="https://picsum.photos/600/400" alt="Our Story" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <h2>Who We Are</h2>
          <p>
            We are a team of designers, developers, and strategists who believe in creating products that make a difference.
            Our mission is to blend creativity with technology to deliver solutions that inspire and empower businesses worldwide.
          </p>
          <p>
            From web development to digital branding, we thrive on challenges and love turning ideas into reality.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-5" data-aos="fade-up">Meet Our Team</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="zoom-in">
          <div class="card team-card">
            <img src="https://picsum.photos/400/400?1" class="card-img-top" alt="Team Member">
            <div class="card-body">
              <h5 class="card-title">Alex Johnson</h5>
              <p class="card-text">CEO & Founder</p>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
          <div class="card team-card">
            <img src="https://picsum.photos/400/400?2" class="card-img-top" alt="Team Member">
            <div class="card-body">
              <h5 class="card-title">Sophia Lee</h5>
              <p class="card-text">Creative Director</p>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
          <div class="card team-card">
            <img src="https://picsum.photos/400/400?3" class="card-img-top" alt="Team Member">
            <div class="card-body">
              <h5 class="card-title">Michael Smith</h5>
              <p class="card-text">Lead Developer</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
  </script>

@endsection