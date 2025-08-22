  @extends('layout.masterlayout')
  @section('content')
  
  
  <div class="container mt-4">
    
    <div class="row g-4">
      
      <!-- Left Side: Form -->
      <div class="col-lg-8">
        <div class="checkout-card">
          <h3 class="checkout-title">Checkout</h3>

          <!-- Product Preview -->
          <div class="product-preview">
            <img src="https://via.placeholder.com/70" alt="Product">
            <div>
              <h6 class="mb-1">Custom Designed Cup</h6>
              <small class="text-muted">1 × $24.99</small>
            </div>
          </div>

          <!-- Billing Information -->
          <h5 class="mb-3">Billing Details</h5>
          <form>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="John">
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Doe">
              </div>
              <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="you@example.com">
              </div>
              <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="1234 Main St">
              </div>
              <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" class="form-control" placeholder="New York">
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
                <label class="form-label">Zip</label>
                <input type="text" class="form-control" placeholder="10001">
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