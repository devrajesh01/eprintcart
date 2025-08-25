@extends('layout.masterlayout')
@section('content')
<section class="thankyou">
  <div class="thankyou-card">
    <div class="thankyou-icon">✔️</div>
    <h2>Thank You for Your Order!</h2>
    <p class="text-muted">Your order has been placed successfully.</p>

    <h5>Order ID: <span class="text-primary">{{ $payment->id }}</span></h5>
    <h5>Transaction ID: <span class="text-primary">{{ $transactionId }}</span></h5>
    <p>Total Amount: <strong>${{ number_format($payment->amount, 2) }}</strong></p>

    <!-- Dynamic Product Details -->
    <div class="ordered-products">
      <h4>Ordered Items:</h4>
      <ul class="product-list">
        @foreach($orderedItems as $item)
        <li class="product-item">
          <img src="{{ asset('uploads/products/' . $item['image']) }}" alt="{{ $item['name'] }}" class="product-img">
          <div class="product-info">
            <span class="product-name">{{ $item['name'] }}</span>
            <span class="product-qty">Qty: {{ $item['quantity'] }}</span>
            <span class="product-price">${{ number_format($item['price'], 2) }}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>

    {{-- <a href="/" class="btn btn-primary mt-3">Continue Shopping</a> --}}
  </div>
</section>
@endsection
