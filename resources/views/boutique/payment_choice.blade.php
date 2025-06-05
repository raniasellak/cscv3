@extends('user.layouts.app')
@section('title', 'Choix du paiement')
@section('content')
<div class="container" style="max-width:600px; margin:auto;">
    <h1 class="subtitle">Choix du mode de paiement</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Résumé du panier</h5>
            <ul class="list-group mb-3">
                @foreach($cart->products as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $product->name }} x {{ $product->pivot->quantity }}
                        <span class="badge bg-primary rounded-pill">{{ number_format($product->price * $product->pivot->quantity, 2) }} €</span>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-between">
                <button id="btn-card" class="btn btn-outline-primary">Payer par carte</button>
                <button id="btn-paypal" class="btn btn-outline-warning">Payer par PayPal</button>
            </div>
            <div id="payment-method" class="mt-4"></div>
        </div>
    </div>
    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Retour au panier</a>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>
<script>
document.getElementById('btn-card').onclick = function() {
    document.getElementById('payment-method').innerHTML = `
        <form id="stripe-form">
            <div class="mb-3">
                <label for="card-element" class="form-label">Carte bancaire</label>
                <div id="card-element" class="form-control"></div>
            </div>
            <button type="submit" class="btn btn-success">Payer avec Stripe</button>
        </form>
    `;
    var stripe = Stripe('pk_test_12345'); // Remplace par ta vraie clé publique Stripe !
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');
    document.getElementById('stripe-form').onsubmit = function(e) {
        e.preventDefault();
        alert('Paiement Stripe fictif (à implémenter côté serveur)');
    };
};
document.getElementById('btn-paypal').onclick = function() {
    document.getElementById('payment-method').innerHTML = `<div id="paypal-button-container"></div>`;
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{ amount: { value: '{{ $cart->products->sum(fn($p) => $p->price * $p->pivot->quantity) }}' } }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Paiement PayPal fictif (à implémenter côté serveur)');
            });
        }
    }).render('#paypal-button-container');
};
</script>
@endsection 