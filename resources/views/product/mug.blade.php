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
<div class="container py-5">
    <h1 class="text-center mb-5">✨ Choose Your Frame ✨</h1>
    <div class="row g-4">

      <div class="col-sm-6 col-md-4 col-lg-4">
        <a href="editor.html?frame=images/frame1.jpg" class="text-decoration-none">
          <div class="card frame-card" style="animation-delay: 0.1s">
            <img src="images/frame1.jpg" class="card-img-top" alt="Frame A">
            <div class="card-body">
              <h5>Customize Design</h5>
              <i class="fa-solid fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-4">
        <a href="editor.html?frame=images/frame2.jpg" class="text-decoration-none">
          <div class="card frame-card" style="animation-delay: 0.2s">
            <img src="images/frame2.jpg" class="card-img-top" alt="Frame B">
            <div class="card-body">
              <h5>Customize Design</h5>
              <i class="fa-solid fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-4">
        <a href="editor.html?frame=images/frame3.jpg" class="text-decoration-none">
          <div class="card frame-card" style="animation-delay: 0.3s">
            <img src="fimages/frame3.jpg" class="card-img-top" alt="Frame C">
            <div class="card-body">
               <h5>Customize Design</h5>
              <i class="fa-solid fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-4">
        <a href="editor.html?frame=images/frame4.jpg" class="text-decoration-none">
          <div class="card frame-card" style="animation-delay: 0.4s">
            <img src="images/frame4.jpg" class="card-img-top" alt="Frame D">
            <div class="card-body">
              <h5>Customize Design</h5>
              <i class="fa-solid fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

    </div>
  </div>


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