@extends('layout.masterlayout')
@section('content')


<div class="container">
  <div class="row g-4 align-items-center">

    <!-- Left Side: Product Image -->
    <div class="col-md-7">
      <div class="card">
        <img src="{{ asset('uploads/products/' . $product->product_image) }}" class="card-img-top"
          alt="{{ $product->product_name }}">
      </div>
    </div>

    <!-- Right Side: Product Info -->
    <div class="col-md-5">
      <h2>{{ $product->product_name }}</h2>
      <p class="text-muted">{{ $product->product_description }}</p>
      <h4 class="text-success mb-3"><i
          class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($product->product_price, 2) }}</h4>

      <ul class="list-unstyled">
        <li>✅ High-resolution wraparound printing</li>
        <li>✅ Durable ceramic material</li>
        <li>✅ Dishwasher & microwave safe</li>
        <li>✅ Worldwide shipping</li>
      </ul>

      <!-- Buy Now Form -->
      <form action="{{ route('checkout', ['id' => $product->id]) }}" method="GET">
        @csrf

        <!-- Quantity Section -->
        <div class="d-flex align-items-center mt-3">
          <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
          <input type="text" id="quantity" name="quantity" class="form-control text-center mx-2" style="width: 70px;"
            value="1" readonly>
          <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
        </div>

        <!-- Submit -->
        <div class="buttons">
          <a href="{{ route('checkout', ['id' => $product->id]) }}" class="btn btn-primary btn-lg mt-3">
            Buy Now
          </a>
          <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn btn-primary btn-lg mt-3">
          Add To Cart
          </a>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- Script -->
<script>
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