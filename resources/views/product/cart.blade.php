@extends('layout.masterlayout')

@section('content')
    <section class="cart-section">
  <div class="cart-container">
    <h2 class="cart-title">Your Shopping Cart</h2>
    
    <table class="cart-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Item 1 -->
        <tr>
          <td class="cart-product">
            <img src="https://via.placeholder.com/80" alt="Product">
            <span>Custom Cup</span>
          </td>
          <td class="price" data-price="19.99">$19.99</td>
          <td>
            <div class="qty-wrapper">
              <button class="qty-btn decrease">-</button>
              <input type="number" value="2" min="1" class="qty-input">
              <button class="qty-btn increase">+</button>
            </div>
          </td>
          <td class="total">$39.98</td>
          <td><button class="remove-btn">✖</button></td>
        </tr>
        <!-- Example Item 2 -->
        <tr>
          <td class="cart-product">
            <img src="https://via.placeholder.com/80" alt="Product">
            <span>Graphic T-shirt</span>
          </td>
          <td class="price" data-price="29.99">$29.99</td>
          <td>
            <div class="qty-wrapper">
              <button class="qty-btn decrease">-</button>
              <input type="number" value="1" min="1" class="qty-input">
              <button class="qty-btn increase">+</button>
            </div>
          </td>
          <td class="total">$29.99</td>
          <td><button class="remove-btn">✖</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Cart Summary -->
    <div class="cart-summary">
      <p>Subtotal: <span id="subtotal">$69.97</span></p>
      <p>Shipping: <span id="shipping">$5.00</span></p>
      <h4>Total: <span id="grand-total">$74.97</span></h4>
      <a href="/checkout" class="btn-checkout">Proceed to Checkout</a>
    </div>
  </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll(".cart-table tbody tr");
    const subtotalEl = document.getElementById("subtotal");
    const grandTotalEl = document.getElementById("grand-total");
    const shippingCost = 5.00;

    function updateTotals() {
        let subtotal = 0;
        rows.forEach(row => {
            const price = parseFloat(row.querySelector(".price").dataset.price);
            const qty = parseInt(row.querySelector(".qty-input").value);
            const total = price * qty;
            row.querySelector(".total").innerText = `$${total.toFixed(2)}`;
            subtotal += total;
        });
        subtotalEl.innerText = `$${subtotal.toFixed(2)}`;
        grandTotalEl.innerText = `$${(subtotal + shippingCost).toFixed(2)}`;
    }

    rows.forEach(row => {
        const decreaseBtn = row.querySelector(".decrease");
        const increaseBtn = row.querySelector(".increase");
        const qtyInput = row.querySelector(".qty-input");

        decreaseBtn.addEventListener("click", () => {
            let qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qtyInput.value = qty - 1;
                updateTotals();
            }
        });

        increaseBtn.addEventListener("click", () => {
            let qty = parseInt(qtyInput.value);
            qtyInput.value = qty + 1;
            updateTotals();
        });

        qtyInput.addEventListener("input", () => {
            if (qtyInput.value < 1) qtyInput.value = 1;
            updateTotals();
        });
    });

    updateTotals(); // Initialize totals
});
</script>



@endsection