@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'layouts.master')
@section('title', 'Paiement par carte')
@section('content')
<div class="container" style="max-width:500px; margin:auto;">
    <h1>Paiement par carte</h1>
    <form id="stripe-form">
        <div class="mb-3">
            <label for="card-element" class="form-label">Carte bancaire</label>
            <div id="card-element" class="form-control"></div>
        </div>
        <button type="submit" class="btn btn-success">Payer</button>
    </form>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
var stripe = Stripe('pk_test_12345'); // Remplace par ta vraie clé publique Stripe !
var elements = stripe.elements();
var card = elements.create('card');
card.mount('#card-element');
document.getElementById('stripe-form').onsubmit = function(e) {
    e.preventDefault();
    alert('Paiement Stripe fictif (à implémenter côté serveur)');
};
</script>
@endsection 