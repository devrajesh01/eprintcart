@extends('layout.masterlayout')

@section('content')
  <section class="shop-section py-5">
    <div class="container">
      <h1 class="mb-5 text-center fw-bold text-primary">🛍 Explore Our Shop</h1>
      <!-- Parent Category Tabs -->
      <ul class="nav nav-tabs justify-content-center shop-tabs" id="mainTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pre-tab" data-bs-toggle="tab" data-bs-target="#pre" type="button"
            role="tab">
            Pre-Designed Products
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="custom-tab" data-bs-toggle="tab" data-bs-target="#custom" type="button" role="tab">
            Customizable Products
          </button>
        </li>
      </ul>
      <div class="tab-content mt-5" id="mainTabsContent">
        <div class="tab-pane fade show active" id="pre" role="tabpanel">
          <div class="row g-4">
            @foreach ($products as $product)
              @php
                $images = $product->product_image ? json_decode($product->product_image, true) : [];
                $firstImage = $images[0] ?? 'default.png';
              @endphp

              <div class="col-md-4">
                <div class="card product-card shadow-sm h-100">
                  <div class="product-img-wrapper">
                    <img src="{{ asset('uploads/products/' . $firstImage) }}" class="card-img-top"
                      alt="{{ $product->product_name }}">
                  </div>
                  <div class="card-body text-center">
                    <h5 class="fw-bold">{{ $product->product_name }}</h5>
                    <p class="price">₹ {{ number_format($product->product_price, 2) }}</p>
                    <p class="category text-muted">{{ $product->product_category }}</p>
                    <a href="{{ route('product.page', ['id' => $product->id]) }}" class="btn btn-theme">View Details</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>





        {{-- <div class="tab-pane fade" id="custom" role="tabpanel">
          <div class="row g-4">
            @foreach ($products as $product)
            @php
            $images = $product->product_image ? json_decode($product->product_image, true) : [];
            $firstImage = $images[0] ?? 'default.png';
            @endphp
            <div class="col-md-4">
              <div class="card product-card shadow-sm h-100">
                <div class="product-img-wrapper">
                  <img src="{{ asset('uploads/products/' . $firstImage) }}" class="card-img-top"
                    alt="{{ $product->product_name }}">
                </div>
                <div class="card-body text-center">
                  <h5 class="fw-bold">{{ $product->product_name }}</h5>
                  <p class="price">₹ {{ number_format($product->product_price, 2) }}</p>
                  <p class="category text-muted">{{ $product->product_category }}</p>
                  <a href="{{ route('product.page', ['id' => $product->id]) }}" class="btn btn-theme">View Details</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div> --}}
        <div class="tab-pane fade" id="custom" role="tabpanel">
          <div class="row g-4">
            @foreach ($products as $product)
              @if($product->product_type === 'customizable')
                @php
                  $images = $product->product_image ? json_decode($product->product_image, true) : [];
                  $firstImage = $images[0] ?? 'default.png';
                @endphp
                <div class="col-md-4">
                  <div class="card product-card shadow-sm h-100">
                    <div class="product-img-wrapper">
                      <img src="{{ asset('uploads/products/' . $firstImage) }}" class="card-img-top"
                        alt="{{ $product->product_name }}">
                    </div>
                    <div class="card-body text-center">
                      <h5 class="fw-bold">{{ $product->product_name }}</h5>
                      <p class="price">₹ {{ number_format($product->product_price, 2) }}</p>
                      <p class="category text-muted">{{ $product->product_category }}</p>
                      <a href="{{ route('product.page', ['id' => $product->id]) }}" class="btn btn-theme">Customize</a>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>


      </div>


    </div>
  </section>
@endsection