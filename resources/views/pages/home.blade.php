@extends('layout/masterlayout')

@section('content')

<!-- Banner -->
<section class="home-banner">
  <div class="slick-slider">
    <!-- Slide 1 -->
    <div>
      <img src="{{ asset('https://img.freepik.com/free-photo/online-shopping-shopping-cart-placed-alongside-notebook-blue_1150-19158.jpg?t=st=1756191933~exp=1756195533~hmac=3ad5eb7471722c07a44d25b674a2fe5a7b08629bbbb109e4d5a0cbb567503e8b&w=2000') }}" alt="Fashion Slide" class="banner-img">
    </div>
    <div>
      <img src="{{ asset('https://img.freepik.com/free-photo/shopping-concept-close-up-portrait-young-beautiful-attractive-redhair-girl-smiling-looking-camera_1258-116839.jpg?t=st=1756192249~exp=1756195849~hmac=cb9919564f8ed2b06c813da81c2db793ea67dbe2d138cdb8ffc30f470d5b42c1&w=2000') }}" alt="Electronics Slide" class="banner-img">
    </div>
    <div>
      <img src="https://img.freepik.com/free-photo/portrat-trendy-feminine-girl-posing-with-shopping-bags-from-store-credit-card-paying-contactl_1258-127340.jpg?t=st=1756192385~exp=1756195985~hmac=4a509d883af8b7195c178fc14707033e7eac0a8abf7073f2fb366f0f1c94a653&w=2000" alt="Home Slide" class="banner-img">
    </div>
  </div>

  <!-- Static Content -->
  <div class="banner-content ">
    <h5>Premium Collections</h5>
    <h1>Discover Stylish Trends<br> & Exclusive Offers</h1>
    <p>Upgrade your wardrobe and lifestyle with handpicked premium products.<br>
       Quality Guaranteed • Free Shipping on 1000+ Orders</p>
    <a href="{{route('shop')}}" class="btn btn-theme">Shop Now <i class="fa-solid fa-arrow-right"></i></a>
    <div class="extra-info">
      <ul>
        <li><i class="fas fa-shipping-fast"></i> Fast Delivery</li>        
        <li><i class="fas fa-lock"></i> Secure Payments</li>
        <li><i class="fas fa-headset"></i> 24/7 Customer Support</li>
      </ul>
    </div>
  </div>
</section> 
@include('utils.card')
<div class="text-center">
   <a href="{{route('shop')}}" class="btn btn-theme">View More <i class="fa-solid fa-arrow-right"></i></a>
</div>
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
