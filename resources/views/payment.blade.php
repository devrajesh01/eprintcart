@extends('layout.masterlayout')
@section('content')

<div class="container mt-4 mb-4">

  {{-- Flash & validation --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  @if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('payment.create') }}" method="POST" id="checkout-form">
    @csrf

    <div class="row g-4">
      {{-- LEFT --}}
      <div class="col-lg-8">
        <div class="checkout-card">
          <h3 class="checkout-title">Checkout</h3>

          {{-- Product preview --}}
          @php $subtotal = 0; @endphp
          @if(isset($order_product))
            {{-- Single product --}}
            <div class="product-preview d-flex align-items-center mb-3">
              <img src="{{ asset('uploads/products/' . $order_product->product_image) }}" alt="Product" width="200" class="me-3">
              <div>
                <h6 class="mb-1">{{ $order_product->product_name }}</h6>
                <small class="text-muted">
                  <span id="qty-label">{{ $quantity }}</span> ×
                  <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($order_product->product_price, 2) }}
                </small>
              </div>
            </div>
            <input type="hidden" name="product_id[]" value="{{ $order_product->id }}">
            <input type="hidden" name="product_quantity[]" value="{{ $quantity }}">
            @php $subtotal += $order_product->product_price * $quantity; @endphp
          @elseif(isset($cartItems))
            {{-- Multiple products from cart --}}
            @foreach($cartItems as $item)
              <div class="product-preview d-flex align-items-center mb-3">
                <img src="{{ asset('uploads/products/' . $item->product->product_image) }}" width="100" class="me-3" alt="{{ $item->product->product_name }}">
                <div>
                  <h6 class="mb-1">{{ $item->product->product_name }}</h6>
                  <small class="text-muted">
                    <span>{{ $item->quantity }}</span> ×
                    <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($item->product->product_price, 2) }}
                  </small>
                </div>
              </div>
              <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
              <input type="hidden" name="product_quantity[]" value="{{ $item->quantity }}">
              @php $subtotal += $item->product->product_price * $item->quantity; @endphp
            @endforeach
          @endif

          {{-- Billing --}}
          <h5 class="mb-3">Billing Details</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="full_name" class="form-control" value="{{ $customer->name ?? '' }}" required>
            </div>
            <div class="col-12">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ $customer->email ?? '' }}" required>
            </div>
            <div class="col-12">
              <label class="form-label">Address</label>
              <input type="text" name="address" class="form-control" placeholder="1234 Main St" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" name="city" class="form-control" placeholder="Enter Your City" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">State</label>
              <select class="form-select" name="state" required>
                <option value="">Choose...</option>
                <option>NY</option>
                <option>CA</option>
                <option>TX</option>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Pin Code</label>
              <input type="number" name="pincode" class="form-control" placeholder="Enter Your Pin" required>
            </div>
          </div>
        </div>
      </div>

      {{-- RIGHT --}}
      <div class="col-lg-4">
        <div class="order-summary">
          <h5>Order Summary</h5>
          <ul class="list-group mb-3">
            @if(isset($order_product))
              <li class="list-group-item d-flex justify-content-between">
                <span>{{ $order_product->product_name }} × <span>{{ $quantity }}</span></span>
                <strong>
                  <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($order_product->product_price * $quantity, 2) }}
                </strong>
              </li>
            @elseif(isset($cartItems))
              @foreach($cartItems as $item)
                <li class="list-group-item d-flex justify-content-between">
                  <span>{{ $item->product->product_name }} × {{ $item->quantity }}</span>
                  <strong>
                    <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($item->product->product_price * $item->quantity, 2) }}
                  </strong>
                </li>
              @endforeach
            @endif
            <li class="list-group-item d-flex justify-content-between">
              <span>Shipping</span>
              <strong><i class="fa-solid fa-indian-rupee-sign"></i>4.99</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Tax</span>
              <strong><i class="fa-solid fa-indian-rupee-sign"></i>2.00</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <strong>Total</strong>
              <strong>
                <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($subtotal + 4.99 + 2.00, 2) }}
              </strong>
            </li>
          </ul>

          {{-- Payment Method --}}
          <h5 class="mt-4">Payment Method</h5>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="paymentMethodId" id="payCard" value="pm_card_visa" checked>
            <label class="form-check-label" for="payCard">Credit Card (Stripe test)</label>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="paymentMethodId" id="payCOD" value="cod">
            <label class="form-check-label" for="payCOD">Cash on Delivery</label>
          </div>

          <div id="card-details">
            <div class="mb-3">
              <label class="form-label">Name on Card</label>
              <input type="text" class="form-control" placeholder="John Doe">
            </div>
            <div class="mb-3">
              <label class="form-label">Card Number</label>
              <input type="text" class="form-control" placeholder="4242 4242 4242 4242 (test)">
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Expiration</label>
                <input type="text" class="form-control" placeholder="MM/YY">
              </div>
              <div class="col-md-6">
                <label class="form-label">CVV</label>
                <input type="text" class="form-control" placeholder="123">
              </div>
            </div>
          </div>

          <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">
            Place Order
          </button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const shipping = 4.99;
  const tax = 2.00;

  const qtyInput = document.getElementById("quantity");
  const qtyLabel = document.getElementById("qty-label");
  const subtotalEl = document.getElementById("summary-subtotal");
  const totalEl = document.getElementById("summary-total");
  const hiddenQuantity = document.getElementById("hidden-quantity");

  if(qtyInput){
    const price = parseFloat(qtyInput.dataset.price || 0);

    function updateSummary() {
      const qty = parseInt(qtyInput.value) || 1;
      const subtotal = price * qty;
      const total = subtotal + shipping + tax;

      qtyLabel.textContent = qty;
      if(subtotalEl) subtotalEl.textContent = subtotal.toFixed(2);
      if(totalEl) totalEl.textContent = total.toFixed(2);
      if(hiddenQuantity) hiddenQuantity.value = qty;
    }

    qtyInput.addEventListener("input", updateSummary);
    updateSummary();
  }

  const radios = document.querySelectorAll('input[name="paymentMethodId"]');
  const cardDetails = document.getElementById("card-details");

  function toggleCardDetails() {
    const selected = document.querySelector('input[name="paymentMethodId"]:checked').value;
    cardDetails.style.display = (selected === "cod") ? "none" : "block";
  }

  toggleCardDetails();
  radios.forEach(r => r.addEventListener("change", toggleCardDetails));
});
</script>
@endsection
