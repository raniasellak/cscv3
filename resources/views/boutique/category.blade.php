{{-- resources/views/boutique/category.blade.php --}}
@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Produits dans la catégorie : {{ $category->name }}</h1>

        @if($products->isEmpty())
            <p class="text-center mt-4">Aucun produit trouvé pour cette catégorie.</p>
        @else
            <div class="row mt-4">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">{{ $product->price }} €</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
