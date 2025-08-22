@extends('layout.masterlayout')
@section('content')
<section class="thankyou">
  <div class="thankyou-card">
    <div class="thankyou-icon">✔️</div>
    <h2>Thank You for Your Order!</h2>
    <p class="text-muted">Your order has been placed successfully.</p>

    <h5>Order ID: <span class="text-primary">123456</span></h5>
    <p>Total Amount: <strong>$49.99</strong></p>

    <!-- Static Product Details -->
    <div class="ordered-products">
      <h4>Ordered Items:</h4>
      <ul class="product-list">
        <li class="product-item">
          <img src="https://via.placeholder.com/60" alt="Cup" class="product-img">
          <div class="product-info">
            <span class="product-name">Custom Printed Cup</span>
            <span class="product-qty">Qty: 2</span>
            <span class="product-price">$19.99</span>
          </div>
        </li>
        <li class="product-item">
          <img src="https://via.placeholder.com/60" alt="T-Shirt" class="product-img">
          <div class="product-info">
            <span class="product-name">Graphic T-Shirt</span>
            <span class="product-qty">Qty: 1</span>
            <span class="product-price">$29.99</span>
          </div>
        </li>
      </ul>
    </div>

    <a href="/" class="btn btn-primary mt-3">Continue Shopping</a>
  </div>
</section>


@endsection