@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'user.layouts.app')
@section('title', 'Paiement PayPal')
@section('content')
<div class="container" style="max-width:500px; margin:auto;">
    <h1>Paiement PayPal</h1>
    <div id="paypal-button-container"></div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>
<script>
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
</script>
@endsection 