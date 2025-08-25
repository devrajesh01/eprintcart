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

            {{-- LEFT: Products & Billing --}}
            <div class="col-lg-8">
                <div class="checkout-card">
                    <h3 class="checkout-title">Checkout</h3>

                    @php $subtotal = 0; @endphp

                    {{-- Single Product --}}
                    @if(isset($order_product))
                        @php
                            $images = json_decode($order_product->product_image, true);
                            $firstImage = is_array($images) ? ($images[0] ?? 'default.png') : $order_product->product_image;
                        @endphp
                        <div class="product-preview d-flex align-items-center mb-3">
                            <img src="{{ asset('uploads/products/' . $firstImage) }}" width="200" class="me-3">
                            <div>
                                <h6>{{ $order_product->product_name }}</h6>
                                <small>{{ $quantity }} × ₹{{ number_format($order_product->product_price, 2) }}</small>
                            </div>
                        </div>
                        <input type="hidden" name="product_id[]" value="{{ $order_product->id }}">
                        <input type="hidden" name="product_quantity[]" value="{{ $quantity }}">
                        @php $subtotal += $order_product->product_price * $quantity; @endphp

                    {{-- Multiple Cart Items --}}
                    @elseif(isset($cartItems))
                        @foreach($cartItems as $item)
                            @php
                                $images = json_decode($item->product->product_image, true);
                                $firstImage = is_array($images) ? ($images[0] ?? 'default.png') : $item->product->product_image;
                            @endphp
                            <div class="product-preview d-flex align-items-center mb-3">
                                <img src="{{ asset('uploads/products/' . $firstImage) }}" width="100" class="me-3">
                                <div>
                                    <h6>{{ $item->product->product_name }}</h6>
                                    <small>{{ $item->quantity }} × ₹{{ number_format($item->product->product_price, 2) }}</small>
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
                            <input type="text" name="full_name" class="form-control" placeholder="Full Name" value="{{ $customer->name ?? '' }}" required>
                        </div>
                        <div class="col-12">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $customer->email ?? '' }}" required>
                        </div>
                        <div class="col-12">
                          <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address" required>
                        </div>
                        <div class="col-md-6">
                          <label for="city">City</label>
                            <input type="text" name="city" class="form-control" placeholder="City" required>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="state" required>
                                <option value="">Choose...</option>
                                <option>NY</option>
                                <option>CA</option>
                                <option>TX</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="pincode" class="form-control" placeholder="Pin Code" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Summary & Payment --}}
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5>Order Summary</h5>
                    <ul class="list-group mb-3">
                        @if(isset($order_product))
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $order_product->product_name }} × {{ $quantity }}
                                <strong>₹{{ number_format($order_product->product_price * $quantity, 2) }}</strong>
                            </li>
                        @elseif(isset($cartItems))
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between">
                                    {{ $item->product->product_name }} × {{ $item->quantity }}
                                    <strong>₹{{ number_format($item->product->product_price * $item->quantity, 2) }}</strong>
                                </li>
                            @endforeach
                        @endif
                        <li class="list-group-item d-flex justify-content-between">Shipping <strong>₹4.99</strong></li>
                        <li class="list-group-item d-flex justify-content-between">Tax <strong>₹2.00</strong></li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>₹{{ number_format($subtotal + 4.99 + 2.00, 2) }}</strong>
                        </li>
                    </ul>

                    {{-- Payment --}}
                    <h5>Payment Method</h5>
                    <div class="form-check mb-3">
                        <input type="radio" name="payment_method" id="payCOD" value="cod" class="form-check-input">
                        <label class="form-check-label" for="payCOD">Cash on Delivery</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="radio" name="payment_method" id="payStripe" value="stripe" class="form-check-input">
                        <label class="form-check-label" for="payStripe">Stripe</label>
                    </div>

                    {{-- Hidden fields --}}
                    <input type="hidden" name="amount" value="{{ $subtotal + 4.99 + 2.00 }}">
                    <input type="hidden" name="currency" value="usd">

                    {{-- Stripe Card --}}
                    <div id="card-element" class="mb-3" style="display:none;"></div>
                    <input type="hidden" name="stripeToken" id="stripeToken">

                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Place Order</button>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- Stripe JS --}}
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    const cardDiv = document.getElementById('card-element');
    card.mount('#card-element');

    const radios = document.querySelectorAll('input[name="payment_method"]');
    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            cardDiv.style.display = this.value === 'stripe' ? 'block' : 'none';
        });
    });

    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', async function(e) {
        const selected = document.querySelector('input[name="payment_method"]:checked');
        if(selected && selected.value === 'stripe') {
            e.preventDefault();
            const {token, error} = await stripe.createToken(card);
            if(error){ alert(error.message); return; }
            document.getElementById('stripeToken').value = token.id;
            form.submit();
        }
    });
});
</script>

@endsection
