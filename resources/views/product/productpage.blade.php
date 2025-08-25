@extends('layout.masterlayout')

@section('content')

@php
    // Decode JSON from DB
    $images = $product->product_image ? json_decode($product->product_image, true) : [];
    $tags = $product->product_tags ? json_decode($product->product_tags, true) : [];
@endphp

<div class="container">
  <div class="row g-4 align-items-start">

    <!-- Left Side: Vertical Thumbnails & Main Image -->
    <div class="col-md-7 d-flex">
      
      <!-- Vertical Thumbnails -->
      <div class="d-flex flex-column me-3" style="max-height:450px; overflow-y:auto;">
        @foreach($images as $img)
          <img src="{{ asset('uploads/products/'.$img) }}" 
               class="img-thumbnail mb-2 small-thumb" 
               style="width:70px; height:70px; cursor:pointer; object-fit:cover;" 
               onclick="changeMainImage('{{ asset('uploads/products/'.$img) }}')">
        @endforeach
      </div>
      
      <!-- Main Image -->
      <div class="flex-grow-1">
        <div class="card">
          <img id="mainImage" 
               src="{{ asset('uploads/products/'.($images[0] ?? 'default.png')) }}" 
               class="card-img-top" 
               alt="{{ $product->product_name }}" 
               style="max-height:450px; object-fit:contain; width:100%;">
        </div>
      </div>
    </div>

    <!-- Right Side: Product Info -->
    <div class="col-md-5">
      <h2>{{ $product->product_name }}</h2>
      <p class="text-muted">{{ $product->product_description }}</p>
      <h4 class="text-success mb-3">
        <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($product->product_price, 2) }}
      </h4>

      <!-- Horizontal Tags -->
      @if(!empty($tags))
        <div class="mb-3">
          <strong>Tags:</strong><br>
          <div class="d-flex flex-wrap mt-2">
            @foreach($tags as $tag)
              <span class="badge bg-secondary me-2 mb-2">{{ $tag }}</span>
            @endforeach
          </div>
        </div>
      @endif

      <ul class="list-unstyled">
        <li>✅ High-resolution wraparound printing</li>
        <li>✅ Durable ceramic material</li>
        <li>✅ Dishwasher & microwave safe</li>
        <li>✅ Worldwide shipping</li>
      </ul>

      <!-- Buy Now Form -->
      <form action="{{ route('checkout', ['id' => $product->id]) }}" method="GET">
        @csrf
        <div class="d-flex align-items-center mt-3">
          <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
          <input type="text" id="quantity" name="quantity" class="form-control text-center mx-2" style="width: 70px;"
            value="1" readonly>
          <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
        </div>

        <div class="buttons">
          <!-- FIX: Buy Now submits the form with quantity -->
          <button type="submit" class="btn btn-primary btn-lg mt-3">Buy Now</button>

          <!-- Add To Cart remains as link -->
          <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn btn-primary btn-lg mt-3">Add To Cart</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script -->
<script>
  // Change main image on thumbnail click
  function changeMainImage(imgUrl) {
    document.getElementById('mainImage').src = imgUrl;
  }

  // Quantity logic
  document.addEventListener("DOMContentLoaded", function () {
    const qtyInput = document.getElementById("quantity");
    const increaseBtn = document.getElementById("increaseQty");
    const decreaseBtn = document.getElementById("decreaseQty");

    increaseBtn.addEventListener("click", function () {
      qtyInput.value = parseInt(qtyInput.value) + 1;
    });

    decreaseBtn.addEventListener("click", function () {
      let current = parseInt(qtyInput.value);
      if (current > 1) {
        qtyInput.value = current - 1;
      }
    });
  });
</script>

@endsection
