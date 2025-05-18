@extends('layouts.master')

@section('title')
Nos Formations
@endsection

@section('styles')
<style>
    .logo {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .logo-bracket {
        color: #333;
    }

    .logo-c {
        color: #333;
    }

    .logo-s {
        color: #ff8c00;
    }

    .logo-c2 {
        color: #ffedaf;
    }

    .btn-orange {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: white;
    }

    .btn-orange:hover {
        background-color: #e07e00;
        border-color: #e07e00;
        color: white;
    }

    .text-orange {
        color: #ff8c00;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ff8c00;
        box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
    }

    .form-check-input:checked {
        background-color: #ff8c00;
        border-color: #ff8c00;
    }
</style>
@endsection

@section('main')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-4">
                <div class="logo">
                    <span class="logo-c">C</span>
                    <span class="logo-s">S</span>
                    <span class="logo-c2">C</span>
                </div>
                <h3 class="font-weight-bold">Nos Formations</h3>
                <p class="text-muted">Découvrez les formations proposées par le club</p>
            </div>

            <!-- Formulaire de filtre par catégorie -->
            <form method="GET" action="{{ route('formations.index') }}" class="mb-4">
                <div class="mb-3">
                    <label for="category" class="form-label">Filtrer par catégorie :</label>
                    <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $cat == $category ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <!-- Messages de session -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Affichage des formations -->
            @if($formations->isEmpty())
                <div class="alert alert-warning">
                    Aucune formation disponible pour le moment.
                </div>
            @else
                <div class="row">
                    @foreach($formations as $formation)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-orange">{{ $formation->title }}</h5>
                                    <p class="mb-1"><strong>Catégorie :</strong> {{ $formation->category }}</p>
                                    <p class="mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}</p>
                                    <p class="mb-2"><strong>Description :</strong> {{ $formation->description }}</p>
                                    <a href="{{ route('formations.show', $formation->id) }}" class="btn btn-orange mt-auto">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
