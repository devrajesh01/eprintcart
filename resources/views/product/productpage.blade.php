@extends('layout.masterlayout')
@section('content')

<div class="container">
  <div class="row g-4 align-items-center">

    <!-- Left Side: Product Image -->
    <div class="col-md-7">
      <div class="card">
        <img src="{{ asset('uploads/products/' . $product->product_image) }}" 
             class="card-img-top"
             alt="{{ $product->product_name }}">
      </div>
    </div>

    <!-- Right Side: Product Info -->
    <div class="col-md-5">
      <h2>{{ $product->product_name }}</h2>
      <p class="text-muted">{{ $product->product_description }}</p>
      <h4 class="text-success mb-3">${{ number_format($product->product_price, 2) }}</h4>

      <ul class="list-unstyled">
        <li>✅ High-resolution wraparound printing</li>
        <li>✅ Durable ceramic material</li>
        <li>✅ Dishwasher & microwave safe</li>
        <li>✅ Worldwide shipping</li>
      </ul>

      <a href="{{ route('checkout', ['id' => $product->id]) }}" 
         class="btn btn-primary btn-lg mt-3">
         Buy Now
      </a>
    </div>

  </div>
</div>

@endsection
