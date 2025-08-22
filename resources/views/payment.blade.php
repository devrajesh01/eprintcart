{{-- @extends('layout.masterlayout')
@section('content')


  <div class="container mt-4">

    <div class="row g-4">

    <!-- Left Side: Form -->
    <div class="col-lg-8">
      <div class="checkout-card">
      <h3 class="checkout-title">Checkout</h3>

      <!-- Product Preview -->
      <div class="product-preview">
        <img src="{{ asset('uploads/products/' . $order_product->product_image) }}" alt="Product" width="70">
        <div>
        <h6 class="mb-1">{{ $order_product->product_name }}</h6>
        <small class="text-muted">1 × ${{ number_format($order_product->product_price, 2) }}</small>
        <p class="text-muted mt-1">{{ $order_product->product_description }}</p>
        </div>
      </div>

      <!-- Hidden fields for product -->
      <input type="hidden" name="product_id" value="{{ $order_product->id }}">
      <input type="hidden" name="product_image" value="{{ $order_product->product_image }}">
      <input type="hidden" name="product_quantity" value="1">
      <input type="hidden" name="amount" value="{{ $order_product->product_price }}">


      <!-- Billing Information -->
      <h5 class="mb-3">Billing Details</h5>
      <form>
        <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" value="{{ $customer->name ?? 'N/A' }}" readonly>
        </div>
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" value="{{ $customer->email ?? 'N/A' }}">
        </div>
        <div class="col-12">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" placeholder="1234 Main St">
        </div>
        <div class="col-md-6">
          <label class="form-label">City</label>
          <input type="text" class="form-control" placeholder="Enter Your City">
        </div>
        <div class="col-md-4">
          <label class="form-label">State</label>
          <select class="form-select">
          <option>Choose...</option>
          <option>NY</option>
          <option>CA</option>
          <option>TX</option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">Pin Code</label>
          <input type="number" class="form-control" placeholder="Enter Your Pin">
        </div>
        </div>
      </form>
      </div>
    </div>

    <!-- Right Side: Order Summary + Payment -->
    <div class="col-lg-4">
      <div class="order-summary">
      <h5>Order Summary</h5>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between">
        <span>Custom Cup x 1</span>
        <strong>$24.99</strong>
        </li>
        <li class="list-group-item d-flex justify-content-between">
        <span>Shipping</span>
        <strong>$4.99</strong>
        </li>
        <li class="list-group-item d-flex justify-content-between">
        <span>Tax</span>
        <strong>$2.00</strong>
        </li>
        <li class="list-group-item d-flex justify-content-between">
        <strong>Total</strong>
        <strong>$31.98</strong>
        </li>
      </ul>

      <!-- Payment Method -->
      <h5 class="mt-4">Payment Method</h5>
      <form>
        <div class="form-check mb-2">
        <input class="form-check-input" type="radio" name="paymentMethod" checked>
        <label class="form-check-label">Credit Card</label>
        </div>
        <div class="form-check mb-2">
        <input class="form-check-input" type="radio" name="paymentMethod">
        <label class="form-check-label">PayPal</label>
        </div>
        <div class="form-check mb-4">
        <input class="form-check-input" type="radio" name="paymentMethod">
        <label class="form-check-label">Cash on Delivery</label>
        </div>

        <div class="mb-3">
        <label class="form-label">Name on Card</label>
        <input type="text" class="form-control" placeholder="John Doe">
        </div>
        <div class="mb-3">
        <label class="form-label">Card Number</label>
        <input type="text" class="form-control" placeholder="xxxx-xxxx-xxxx-1234">
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

        <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Place Order</button>
      </form>
      </div>
    </div>

    </div>
  </div>
@endsection
 --}}


 @extends('layout.masterlayout')
@section('content')

<div class="container mt-4">
  <div class="row g-4">

    <!-- Left: Form -->
    <div class="col-lg-8">
      <div class="checkout-card">
        <h3 class="checkout-title">Checkout</h3>

        <!-- Product Preview -->
        <div class="product-preview">
          <img src="{{ asset('uploads/products/' . $order_product->product_image) }}" alt="Product" width="70">
          <div>
            <h6 class="mb-1">{{ $order_product->product_name }}</h6>
            <small class="text-muted">Unit Price: ${{ number_format($order_product->product_price, 2) }}</small>
            <p class="text-muted mt-1">{{ $order_product->product_description }}</p>
          </div>
        </div>

        <!-- Billing Information -->
        <h5 class="mb-3">Billing Details</h5>

        <form id="checkout-form" method="POST" action="{{ route('payment.create') }}">
          @csrf

          <!-- Trusted server-side data -->
          <input type="hidden" name="product_id" value="{{ $order_product->id }}">
          <input type="hidden" name="paymentMethodId" id="paymentMethodId" value="cod"><!-- default COD -->

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" value="{{ $customer->name ?? '' }}" readonly>
            </div>

            <div class="col-12">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" value="{{ $customer->email ?? '' }}" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label">Quantity</label>
              <input type="number" class="form-control" name="product_quantity" value="1" min="1">
            </div>

            <div class="col-12">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
            </div>
          </div>

          <!-- Payment Method -->
          <h5 class="mt-4">Payment Method</h5>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="pay_method" id="pay_cod" value="cod" checked>
            <label class="form-check-label" for="pay_cod">Cash on Delivery</label>
          </div>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="pay_method" id="pay_card" value="card">
            <label class="form-check-label" for="pay_card">Credit/Debit Card</label>
          </div>

          <!-- Stripe Card Element (only shown if card selected) -->
          <div id="card-section" class="mt-3" style="display:none;">
            <label class="form-label">Card Details</label>
            <div id="card-element" class="form-control"></div>
            <small id="card-errors" class="text-danger d-block mt-2"></small>
          </div>

          <button class="btn btn-primary btn-lg w-100 mt-4" type="submit" id="pay-btn">
            Place Order
          </button>
        </form>

        @if(session('success')) <div class="alert alert-success mt-3">{{ session('success') }}</div> @endif
        @if(session('error'))   <div class="alert alert-danger mt-3">{{ session('error') }}</div>   @endif
        @if(session('info'))    <div class="alert alert-info mt-3">{{ session('info') }}</div>      @endif
      </div>
    </div>

    <!-- Right: Summary -->
    <div class="col-lg-4">
      <div class="order-summary">
        <h5>Order Summary</h5>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between">
            <span>{{ $order_product->product_name }} × <span id="qty-label">1</span></span>
            <strong id="subtotal">${{ number_format($order_product->product_price, 2) }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <strong>Total</strong>
            <strong id="total">${{ number_format($order_product->product_price, 2) }}</strong>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>

{{-- Stripe.js --}}
<script src="https://js.stripe.com/v3"></script>
<script>
  const unitPrice = {{ json_encode($order_product->product_price) }};
  const qtyInput  = document.querySelector('input[name="product_quantity"]');
  const qtyLabel  = document.getElementById('qty-label');
  const subtotal  = document.getElementById('subtotal');
  const total     = document.getElementById('total');

  const methodCod  = document.getElementById('pay_cod');
  const methodCard = document.getElementById('pay_card');
  const cardSection = document.getElementById('card-section');
  const pmInput    = document.getElementById('paymentMethodId');

  // Update totals on qty change
  function recalc() {
    const q = Math.max(1, parseInt(qtyInput.value || '1', 10));
    qtyLabel.textContent = q;
    const amount = (unitPrice * q).toFixed(2);
    subtotal.textContent = '$' + amount;
    total.textContent    = '$' + amount;
  }
  qtyInput.addEventListener('input', recalc);
  recalc();

  // Toggle Stripe card section
  function toggleMethod() {
    if (methodCard.checked) {
      cardSection.style.display = 'block';
    } else {
      cardSection.style.display = 'none';
      pmInput.value = 'cod';
    }
  }
  methodCod.addEventListener('change', toggleMethod);
  methodCard.addEventListener('change', toggleMethod);
  toggleMethod();

  // Stripe setup (only if card selected)
  const stripe = Stripe('{{ config('services.stripe.key') }}');
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  card.on('change', function(event) {
    document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
  });

  // Intercept submit to create PaymentMethod if card selected
  const form = document.getElementById('checkout-form');
  const payBtn = document.getElementById('pay-btn');

  form.addEventListener('submit', async function(e) {
    if (!methodCard.checked) return; // COD, allow normal submit

    e.preventDefault();
    payBtn.disabled = true;

    const { paymentMethod, error } = await stripe.createPaymentMethod({
      type: 'card',
      card: card,
    });

    if (error) {
      document.getElementById('card-errors').textContent = error.message;
      payBtn.disabled = false;
      return;
    }

    // Put pm_xxx into hidden field, then submit
    pmInput.value = paymentMethod.id;
    form.submit();
  });
</script>
@endsection
