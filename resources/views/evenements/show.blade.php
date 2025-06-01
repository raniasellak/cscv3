@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <a href="{{ route('evenements.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Retour
    </a>

    <div class="card shadow">
        <div class="card-body">
            <h1 class="card-title mb-3">{{ $evenement->titre }}</h1>

            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</p>
            <p><strong>Lieu :</strong> {{ $evenement->lieu ?? 'Non spécifié' }}</p>
            <p><strong>Description :</strong><br> {{ $evenement->description ?? 'Aucune description' }}</p>

            @if (!empty($evenement->long_description))
                <hr>
                <p><strong>Description longue :</strong></p>
                <div class="bg-light border rounded p-3 mb-3" style="white-space: pre-wrap;">
                    {{ $evenement->long_description }}
                </div>
            @endif

            <hr>
            <h3 class="text-warning mb-3">
                <i class="bi bi-calendar-week"></i> Agenda
            </h3>

            @if(empty($agenda) || count($agenda) === 0)
                <div class="alert alert-warning">Aucun agenda disponible pour cet événement.</div>
            @else
                @foreach($agenda as $day => $sessions)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">{{ $day }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($sessions as $session)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-clock"></i>
                                        <strong>{{ $session['title'] }}</strong>
                                    </div>
                                    <small class="text-muted">{{ $session['time'] }}</small>
                                </li>
                            @empty
                                <li class="list-group-item text-muted fst-italic">Aucune session pour ce jour.</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            @endif

           
            @if (auth()->check() && auth()->user()->role == 'admin')
        <div class="action-buttons">
            <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-warning btn-custom">Modifier</a>
            <form action="{{ route('evenements.destroy', $evenement) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
            </form>
        </div>
        @endif
        </div>
    </div>
</div>
@endsection
