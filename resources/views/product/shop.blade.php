@extends('layout.masterlayout')

@section('content')
<section class="shop" >
    <div class="container">
  <h1 class="mb-4 text-center">🛍 Shop</h1>

  <!-- Major Category Tabs -->
  <ul class="nav nav-tabs justify-content-center" id="mainTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pre-tab" data-bs-toggle="tab" data-bs-target="#pre" type="button" role="tab">Pre-Designed Products</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="custom-tab" data-bs-toggle="tab" data-bs-target="#custom" type="button" role="tab">Customizable Products</button>
    </li>
  </ul>

  <div class="tab-content mt-4" id="mainTabsContent">
    
    <!-- Pre-designed Products Tab -->
    <div class="tab-pane fade show active" id="pre" role="tabpanel">
      <!-- Subcategory Tabs -->
      <ul class="nav nav-pills justify-content-center subcategory-tabs" id="preSubTabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" id="pre-tshirts-tab" data-bs-toggle="tab" data-bs-target="#pre-tshirts" type="button" role="tab">T-Shirts</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="pre-saree-tab" data-bs-toggle="tab" data-bs-target="#pre-saree" type="button" role="tab">Sarees</button>
        </li>
      </ul>
      <div class="tab-content mt-3">
        <!-- Pre-designed T-Shirts -->
        <div class="tab-pane fade show active" id="pre-tshirts" role="tabpanel">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card product-card">
                <img src="{{asset('images/frame1.webp')}}" alt="">
                <div class="card-body">
                  <h5>Pre T-Shirt 1</h5>
                  <p>$25</p>
                  <button class="btn btn-sm btn-primary">Buy Now</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card product-card">
                <img src="{{asset('images/frame1.webp')}}" alt="">
                <div class="card-body">
                  <h5>Pre T-Shirt 2</h5>
                  <p>$28</p>
                  <button class="btn btn-sm btn-primary">Buy Now</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pre-designed Sarees -->
        <div class="tab-pane fade" id="pre-saree" role="tabpanel">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card product-card">
                <img src="{{asset('images/frame1.webp')}}" alt="">
                <div class="card-body">
                  <h5>Pre Saree 1</h5>
                  <p>$50</p>
                  <button class="btn btn-sm btn-primary">Buy Now</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card product-card">
                <img src="{{asset('images/frame1.webp')}}" alt="">
                <div class="card-body">
                  <h5>Pre Saree 2</h5>
                  <p>$55</p>
                  <button class="btn btn-sm btn-primary">Buy Now</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Customizable Products Tab -->
    <div class="tab-pane fade" id="custom" role="tabpanel">
      <!-- Subcategory Tabs -->
      <ul class="nav nav-pills justify-content-center subcategory-tabs" id="customSubTabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" id="custom-tshirts-tab" data-bs-toggle="tab" data-bs-target="#custom-tshirts" type="button" role="tab">T-Shirts</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="custom-saree-tab" data-bs-toggle="tab" data-bs-target="#custom-saree" type="button" role="tab">Sarees</button>
        </li>
      </ul>
      <div class="tab-content mt-3">
        <!-- Customizable T-Shirts -->
        <div class="tab-pane fade show active" id="custom-tshirts" role="tabpanel">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card product-card">
                <img src="{{asset('images/frame1.webp')}}" alt="">
                <div class="card-body">
                  <h5>Custom T-Shirt 1</h5>
                  <p>$30</p>
                  <button class="btn btn-sm btn-success">Customize</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Customizable Sarees -->
        <div class="tab-pane fade" id="custom-saree" role="tabpanel">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card product-card">
                <img src="{{asset('images/frame1.webp')}}" alt="">
                <div class="card-body">
                  <h5>Custom Saree 1</h5>
                  <p>$60</p>
                  <button class="btn btn-sm btn-success">Customize</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>

    
@endsection