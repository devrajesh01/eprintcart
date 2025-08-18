<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h2>Stripe Payment Demo</h2>

    <form id="payment-form">
        <label for="card-element">Credit or debit card</label>
        <div id="card-element"></div>
        <input type="hidden" id="amount" value="10"> <!-- Amount in USD -->
        <button id="submit">Pay $10</button>
    </form>

    <div id="payment-result"></div>
</body>
 <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {paymentMethod, error} = await stripe.createPaymentMethod('card', card);

            if (error) {
                document.getElementById('payment-result').innerText = error.message;
                return;
            }

            const response = await fetch("{{ route('payment.create') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id,
                    amount: document.getElementById('amount').value
                })
            });

            const data = await response.json();
            if (data.success) {
                document.getElementById('payment-result').innerText = "Payment Successful! ID: " + data.paymentIntent.id;
            } else {
                document.getElementById('payment-result').innerText = "Error: " + data.message;
            }
        });
    </script>
</html>
