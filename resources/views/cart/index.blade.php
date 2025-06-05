@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'user.layouts.app')
@section('title', 'Mon Panier')

@section('content')
<style>
@media (min-width: 1025px) {
  .h-custom {
    height: 100vh !important;
  }
}
.card-registration .select-input.form-control[readonly]:not([disabled]) {
  font-size: 1rem;
  line-height: 2.15;
  padding-left: .75em;
  padding-right: .75em;
}
.card-registration .select-arrow {
  top: 13px;
}
.btn-quantity {
  color: #333 !important;
  background: #fff !important;
  border: 1px solid #ced4da;
  border-radius: 4px;
  width: 35px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.9rem;
  font-weight: bold;
  padding: 0;
  transition: all 0.2s ease;
}
.btn-quantity:hover {
  color: #fff !important;
  background: #007bff !important;
  border-color: #007bff;
  transform: scale(1.05);
}
.quantity-input {
  border: 1px solid #ced4da;
  border-left: none;
  border-right: none;
  border-radius: 0;
  text-align: center;
  width: 60px;
  height: 35px;
  background: #fff;
  font-weight: 500;
}
.quantity-container {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

<section class="h-100 h-custom" style="background-color:rgb(45, 45, 48);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0">Mon Panier</h1>
                    <h6 class="mb-0 text-muted">{{ $cart && $cart->products->count() ? $cart->products->sum('pivot.quantity') : 0 }} articles</h6>
                  </div>
                  <hr class="my-4">

                  @forelse($cart->products as $product)
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img src="{{ $product->image ?? 'https://via.placeholder.com/100' }}" class="img-fluid rounded-3" alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted">{{ $product->category->name ?? '' }}</h6>
                      <h6 class="mb-0">{{ $product->name }}</h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex align-items-center justify-content-center">
                      <div class="quantity-container">
                        <!-- Bouton - à gauche -->
                        <form action="{{ route('cart.remove', $product->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <button class="btn btn-quantity" type="submit" title="Diminuer">
                            <span style="color: #000; font-size: 16px; font-weight: bold;">−</span>
                          </button>
                        </form>
                        
                        <!-- Input quantité au centre -->
                        <input min="1" name="quantity" value="{{ $product->pivot->quantity }}" type="number" class="form-control quantity-input" readonly />
                        
                        <!-- Bouton + à droite -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <button class="btn btn-quantity" type="submit" title="Ajouter">
                            <span style="color: #000; font-size: 16px; font-weight: bold;">+</span>
                          </button>
                        </form>
                      </div>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0">€ {{ number_format($product->price * $product->pivot->quantity, 2) }}</h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-muted"><i class="fas fa-times"></i></button>
                      </form>
                    </div>
                  </div>
                  <hr class="my-4">
                  @empty
                  <p>Votre panier est vide.</p>
                  @endforelse

                  <div class="pt-5">
                    <h6 class="mb-0">
                      <a href="{{ route('boutique.index') }}" class="text-body">
                        <i class="fas fa-long-arrow-alt-left me-2"></i>Retour à la boutique
                      </a>
                    </h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-body-tertiary">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Résumé</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Articles</h5>
                    <h5>{{ $cart && $cart->products->count() ? $cart->products->sum('pivot.quantity') : 0 }}</h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Livraison</h5>
                  <div class="mb-4 pb-2">
                    <select class="form-select">
                      <option value="1">Standard - 5.00 €</option>
                    </select>
                  </div>

                  <h5 class="text-uppercase mb-3">Code promo</h5>
                  <div class="mb-5">
                    <input type="text" class="form-control form-control-lg" placeholder="Entrez votre code" />
                  </div>

                  <hr class="my-4">

                  @php
                    $total = $cart && $cart->products->count() ? $cart->products->sum(fn($p) => $p->price * $p->pivot->quantity) : 0;
                    $shipping = $cart && $cart->products->count() ? 5 : 0;
                  @endphp
                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total</h5>
                    <h5>€ {{ number_format($total + $shipping, 2) }}</h5>
                  </div>

                  <a href="{{ route('payment.choice', $cart->id) }}" class="btn btn-dark btn-block btn-lg">Payer</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection