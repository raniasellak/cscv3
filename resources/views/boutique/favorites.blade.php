@extends('user.layouts.app')

@section('content')
<div class="container">
    <h1 class="subtitle">Mes Favoris</h1>
    @if(session('favorites') && count(session('favorites')) > 0)
        <div class="products">
            @foreach(session('favorites') as $product)
                <div class="product-card">
                    <div class="product-img">
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $product['name'] }}</h3>
                        <p class="product-description">{{ $product['description'] }}</p>
                        <div class="product-price">{{ $product['price'] }} DH</div>
                        <div class="product-actions">
                            <form action="{{ route('favorites.remove', $product['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Retirer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Vous n'avez pas encore de favoris.</div>
    @endif
</div>
@endsection 