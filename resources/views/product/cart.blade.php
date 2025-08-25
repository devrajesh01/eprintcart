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
        @foreach($cartItems as $item)
          @php
            // product_image is JSON array; show the first image
            $imgs = $item->product->product_image ? json_decode($item->product->product_image, true) : [];
            $firstImg = $imgs[0] ?? 'default.png';
          @endphp
          <tr data-id="{{ $item->id }}">
            <td class="cart-product" style="display:flex; align-items:center; gap:10px;">
              <img src="{{ asset('uploads/products/'.$firstImg) }}"
                   alt="{{ $item->product->product_name }}"
                   style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
              <span>{{ $item->product->product_name }}</span>
            </td>

            <td class="price" data-price="{{ $item->product->product_price }}">
              ₹{{ number_format($item->product->product_price, 2) }}
            </td>

            <td>
              <div class="qty-wrapper" style="display:inline-flex; align-items:center; gap:6px;">
                <button type="button" class="qty-btn decrease" style="padding:4px 10px;">-</button>
                <input type="number" class="qty-input" min="1" value="{{ $item->quantity }}" style="width:64px; text-align:center;">
                <button type="button" class="qty-btn increase" style="padding:4px 10px;">+</button>
              </div>
            </td>

            <td class="total">₹{{ number_format($item->product->product_price * $item->quantity, 2) }}</td>

            <td>
              <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="remove-btn" type="submit" style="padding:4px 8px;">✖</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="cart-summary" style="margin-top:16px;">
      <p>Subtotal: <span id="subtotal">₹0.00</span></p>
      <p>Shipping: <span id="shipping">₹5.00</span></p>
      <h4>Total: <span id="grand-total">₹0.00</span></h4>

      @if($cartItems->count() > 0)
        <a href="{{ route('checkout.all') }}" class="btn-checkout">Proceed to Checkout</a>
      @endif
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const tableBody = document.querySelector(".cart-table tbody");
  const subtotalEl = document.getElementById("subtotal");
  const grandTotalEl = document.getElementById("grand-total");
  const shippingCost = 5.00;

  function clampQty(v) {
    v = parseInt(v);
    return isNaN(v) || v < 1 ? 1 : v;
  }

  function rowTotal(row) {
    const price = parseFloat(row.querySelector(".price").dataset.price || "0");
    const qty = clampQty(row.querySelector(".qty-input").value);
    const total = price * qty;
    row.querySelector(".total").textContent = "₹" + total.toFixed(2);
    return total;
  }

  function updateTotals() {
    let subtotal = 0;
    document.querySelectorAll(".cart-table tbody tr").forEach(row => {
      subtotal += rowTotal(row);
    });
    subtotalEl.textContent = "₹" + subtotal.toFixed(2);
    grandTotalEl.textContent = "₹" + (subtotal + shippingCost).toFixed(2);
  }

  function saveQuantity(cartItemId, qty) {
    // Requires <meta name="csrf-token" ...> in layout
    fetch(`/cart/update/${cartItemId}`, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        "Accept": "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ quantity: qty })
    }).then(r => r.json()).catch(() => {});
  }

  // Event delegation for reliable +/- handling
  tableBody.addEventListener("click", function (e) {
    const incBtn = e.target.closest(".increase");
    const decBtn = e.target.closest(".decrease");
    if (!incBtn && !decBtn) return;

    const row = e.target.closest("tr");
    const input = row.querySelector(".qty-input");
    let qty = clampQty(input.value);

    if (incBtn) qty++;
    if (decBtn) qty = Math.max(1, qty - 1);

    input.value = qty;
    updateTotals();
    saveQuantity(row.dataset.id, qty);
  });

  tableBody.addEventListener("input", function (e) {
    if (!e.target.matches(".qty-input")) return;
    const row = e.target.closest("tr");
    e.target.value = clampQty(e.target.value);
    updateTotals();
    saveQuantity(row.dataset.id, e.target.value);
  });

  // Initial totals
  updateTotals();
});
</script>
@endsection
