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
    
@endsection