@extends('layout.masterlayout')

@section('content')
{{-- @dd($cartItems); --}}
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
        <tr data-id="{{ $item->id }}">
          <td class="cart-product">
            @php
            $imagePath = Str::contains($item->product->product_image, 'uploads/products/')
            ? $item->product->product_image
            : 'uploads/products/' . $item->product->product_image;
            @endphp

            <img src="{{ asset($imagePath) }}" class="card-img-top" alt="{{ $item->product->product_name }}">
            <span>{{ $item->product_name }}</span>
          </td>

          <td class="price" data-price="{{ $item->product->product_price }}">
            <i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($item->product->product_price, 2) }}
          </td>

          <td>
            <div class="qty-wrapper">
              <button class="qty-btn decrease">-</button>
              <input type="number" value="{{ $item->quantity }}" min="1" class="qty-input">
              <button class="qty-btn increase">+</button>
            </div>
          </td>

          <td class="total">₹{{ number_format($item->product->product_price * $item->quantity, 2) }}</td>

          <td>
            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="remove-btn">✖</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Cart Summary -->
    <div class="cart-summary">
      <p>Subtotal: <span id="subtotal">₹0.00</span></p>
      <p>Shipping: <span id="shipping">₹5.00</span></p>
      <h4>Total: <span id="grand-total">₹0.00</span></h4>
      @if($cartItems->count() > 0)
      <a href="{{ route('checkout.all', ['id' => $cartItems->first()->id]) }}" class="btn-checkout">Proceed to Checkout</a>
      @endif
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
            row.querySelector(".total").innerText = "₹" + total.toFixed(2);
            subtotal += total;
        });
        subtotalEl.innerText = "₹" + subtotal.toFixed(2);
        grandTotalEl.innerText = "₹" + (subtotal + shippingCost).toFixed(2);
    }

    // 🔥 Function to save updated qty to DB via AJAX
    function saveQuantity(cartItemId, qty) {
        fetch(`/cart/update/${cartItemId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ quantity: qty })
        })
        .then(res => res.json())
        .then(data => {
            console.log("Saved to DB:", data);
        });
    }

    rows.forEach(row => {
        const decreaseBtn = row.querySelector(".decrease");
        const increaseBtn = row.querySelector(".increase");
        const qtyInput = row.querySelector(".qty-input");
        const cartItemId = row.dataset.id;

        decreaseBtn.addEventListener("click", () => {
            let qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qtyInput.value = qty - 1;
                updateTotals();
                saveQuantity(cartItemId, qtyInput.value);
            }
        });

        increaseBtn.addEventListener("click", () => {
            let qty = parseInt(qtyInput.value);
            qtyInput.value = qty + 1;
            updateTotals();
            saveQuantity(cartItemId, qtyInput.value);
        });

        qtyInput.addEventListener("input", () => {
            if (qtyInput.value < 1) qtyInput.value = 1;
            updateTotals();
            saveQuantity(cartItemId, qtyInput.value);
        });
    });

    updateTotals(); // Initialize totals
});
</script>
@endsection