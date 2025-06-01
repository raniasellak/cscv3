@extends('layouts.master')

@section('title', 'Nos Événements')

@section('styles')
<style>
    .logo {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
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
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <div class="logo">
            <span class="logo-c">C</span>
            <span class="logo-s">S</span>
            <span class="logo-c2">C</span>
        </div>
        <h3 class="font-weight-bold">Nos Événements</h3>
        <p class="text-muted">Découvrez les événements organisés par le club</p>
    </div>


    <!-- Messages de session -->
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Liste des événements -->
    @if($evenements->isEmpty())
        <div class="alert alert-warning">Aucun événement disponible pour le moment.</div>
    @else
        <div class="row">
            @foreach($evenements as $evenement)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-orange">{{ $evenement->titre }}</h5>
                            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</p>
                            <p><strong>Lieu :</strong> {{ $evenement->lieu ?? '-' }}</p>
                            <p class="mb-2"><strong>Description :</strong> {{ Str::limit($evenement->description, 100) }}</p>
                            <a href="{{ route('evenements.show', $evenement) }}" class="btn btn-orange mt-auto">Voir les détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
