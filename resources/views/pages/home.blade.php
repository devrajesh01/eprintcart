@extends('layout/masterlayout')

@section('content')
<!-- Banner Section -->
  <section class="banner-section">
    <!-- Slider Background -->
    <div class="container">
        <div class="banner-slider">      
      <div><img src="{{asset('images/slider1.jpg')}}" alt="Slide 2"></div>
      <div><img src="{{asset('images/slider2.png')}}" alt="Slide 2"></div>
      <div><img src="{{asset('images/slider3.png')}}" alt="Slide 2"></div>
      <div><img src="{{asset('images/slider4.jpg')}}" alt="Slide 2"></div>
          
    </div>
    </div>

    <!-- Fixed Content -->
    {{-- <div class="banner-content">
      <h1>Welcome to Our Website</h1>
      <p>We deliver amazing products and services just for you.</p>
      <a class="btnn btnn-blue" href="#">Get Started</a>
    </div> --}}
  </section>

@include('utils.card')

  <section class="py-5">
  <div class="container">
    <div class="row align-items-center">

      <!-- Mission -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="p-4 h-100 bg-light rounded shadow-sm text-center">
          <h2 class="mb-4 fw-bold">Our Mission</h2>
          <p class="lead text-muted">
            In line with our vision, we wish to be recognized as an organization renowned for its 
            creative solutions, innovation, and quality.
          </p>
          <p>
            We also aim to re-calibrate the benchmark standards in designing and printing 
            products tailored to meet the needs of a diverse customer base.
          </p>
        </div>
      </div>

      <!-- Vision -->
      <div class="col-lg-6">
        <div class="p-4 h-100 text-white rounded shadow-sm" 
             style="background: linear-gradient(135deg, #0044ff, #0066cc);">
          <h2 class="mb-4 fw-bold">We Are Homegrown</h2>
          <ul class="list-unstyled fs-5">
            <li>✅ Printing Memories</li>
            <li>✅ Everything is Personalised</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>  

@endsection
