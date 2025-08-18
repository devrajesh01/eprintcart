@extends('layout.masterlayout')

@section('content')
<!-- Banner Section -->
<section class="hero-banner d-flex align-items-center text-center text-white">
  <div class="overlay"></div>
  <div class="container position-relative">    
    <h3>CUSTOMIZED PHOTO MUGS PRINTINGS START @ rs.299/-</h3>
    <p class="lead mb-4 text-white">
      Custom Coffee Mugs with Photos, Text And Logos. Choose Photo Mugs From Our Different Colours. Order Your Custom Mugs Now.
    </p>    
  </div>
</section>
<style>
.hero-banner{
background: url('{{ asset('images/mug-image.avif') }}') center/cover no-repeat;
}
</style>

<!-- Steps Section -->
<section class="steps py-5 bg-light text-center">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="step-box p-4 shadow-sm rounded h-100 bg-white">
          <span class="badge bg-primary fs-5 mb-2">1</span>
          <h5 class="fw-bold">Select Design</h5>
          <p class="text-muted">Choose your favorite product and template.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="step-box p-4 shadow-sm rounded h-100 bg-white">
          <span class="badge bg-success fs-5 mb-2">2</span>
          <h5 class="fw-bold">Upload Photo / Text</h5>
          <p class="text-muted">Personalize it with your photos or text.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="step-box p-4 shadow-sm rounded h-100 bg-white">
          <span class="badge bg-warning fs-5 mb-2">3</span>
          <h5 class="fw-bold">Buy</h5>
          <p class="text-muted">Place your order and we’ll print it for you.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Products Section -->
<section class="products py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Product 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm h-100 text-center">
          <img src="{{ asset('images/mug.jpg') }}" 
               class="card-img-top" alt="Mug Design"
               style="height:250px; object-fit:cover;">
          <div class="card-body">
            <h5 class="card-title">Custom Mug</h5>
            <p class="text-muted">₹299</p>
            <a href="/design/mug" class="btn btn-primary w-100 rounded-pill">Design Now</a>
          </div>
        </div>
      </div>
      
      <!-- Product 2 -->
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm h-100 text-center">
          <img src="{{ asset('images/tshirt.jpg') }}" 
               class="card-img-top" alt="T-shirt Design"
               style="height:250px; object-fit:cover;">
          <div class="card-body">
            <h5 class="card-title">Custom T-shirt</h5>
            <p class="text-muted">₹499</p>
            <a href="/design/tshirt" class="btn btn-primary w-100 rounded-pill">Design Now</a>
          </div>
        </div>
      </div>

      <!-- Product 3 -->
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm h-100 text-center">
          <img src="{{ asset('images/photo-frame.jpg') }}" 
               class="card-img-top" alt="Photo Frame"
               style="height:250px; object-fit:cover;">
          <div class="card-body">
            <h5 class="card-title">Photo Frame</h5>
            <p class="text-muted">₹399</p>
            <a href="/design/frame" class="btn btn-primary w-100 rounded-pill">Design Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.step-box {
  transition: all 0.3s ease;
}
.step-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.card:hover {
  transform: translateY(-5px);
  transition: 0.3s ease-in-out;
}
</style>


    
@endsection