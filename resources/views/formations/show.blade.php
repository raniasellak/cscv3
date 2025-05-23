@extends('layouts.appp')

@section('title', $formation->title . ' - CSC Formations')

@section('content')
<style>
    :root {
        --primary-color: #F7941D;
    }

    h2.formation-title {
        font-weight: 600;
        margin-bottom: 25px;
        color: #212529;
        border-left: 5px solid #F7941D;
        padding-left: 15px;
    }

    .formation-card, .section-card {
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .formation-info p {
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #eee;
    }

    .formation-info p:last-child {
        border-bottom: none;
    }

    .formation-info strong {
        font-weight: 600;
        min-width: 150px;
        display: inline-block;
    }

    .action-buttons {
        margin-top: 30px;
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-custom {
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
    }

    .btn-primary.btn-custom {
        background-color: #F7941D;
        border-color: #F7941D;
    }

    .btn-primary.btn-custom:hover {
        background-color: #e07e0a;
        border-color: #e07e0a;
        box-shadow: 0 4px 8px rgba(247, 148, 29, 0.4);
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <h2 class="formation-title mt-4">{{ $formation->title }}</h2>

    <div class="formation-card">
        <div class="formation-info">
            <p><strong>Description :</strong> {{ $formation->description }}</p>
            <p><strong>Catégorie :</strong> {{ $formation->category }}</p>
            <p><strong>Formateur :</strong> {{ $formation->formateur_email }}</p>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}</p>

            @if ($formation->recording)
                <p><strong>Enregistrement :</strong> <a href="{{ $formation->recording }}" target="_blank" style="color: #F7941D;">Voir l'enregistrement</a></p>
            @endif

            @if ($formation->support_course)
                <p><strong>Support de cours :</strong> <a href="{{ $formation->support_course }}" target="_blank" style="color: #F7941D;">Voir le support</a></p>
            @endif

            <p><strong>Contenu :</strong><br>{{ $formation->contenu }}</p>
        </div>

        @if (auth()->check() && auth()->user()->role == 'admin')
        <div class="action-buttons">
            <a href="{{ route('formations.index') }}" class="btn btn-secondary btn-custom">Retour</a>
            <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-warning btn-custom">Modifier</a>
            <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')">Supprimer</button>
            </form>
        </div>
        @endif
    </div>

    {{-- Section inscription pour utilisateurs non-admin --}}
    @if (auth()->check() && auth()->user()->role !== 'admin')
        <div class="section-card">
            <h3>S'inscrire à cette formation</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @php
                $userInscrit = $formation->inscriptions->contains('user_id', auth()->id());
                $inscription = $formation->inscriptions->firstWhere('user_id', auth()->id());
            @endphp

            @if ($isPassed)
                <div class="alert alert-warning">Cette formation est déjà passée.</div>

                @if ($userInscrit && $inscription && $inscription->presence)
                    <div class="mt-3">
                        <a href="{{ route('attestation.show', $inscription->id) }}" class="btn btn-sm btn-outline-success">
                            Attestation
                        </a>
                    </div>
                @endif
            @else
                @if (!$userInscrit)
                    <form action="{{ route('inscriptions.quick', $formation->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-custom">S'inscrire</button>
                    </form>
                @else
                    <div class="alert alert-info">Vous êtes déjà inscrit à cette formation.</div>
                @endif
            @endif
        </div>
    @endif

    {{-- Section admin : liste des inscrits et présence --}}
    @if (auth()->check() && auth()->user()->role == 'admin')
        <div class="section-card">
            <h4>Liste des inscrits</h4>

            @if ($formation->inscriptions->count())
                <form action="{{ route('formations.presence', $formation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <ul class="list-group">
                        @foreach ($formation->inscriptions as $inscription)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $inscription->user->name ?? $inscription->nom }}</strong> —
                                    <small>{{ $inscription->user->email ?? $inscription->email }}</small>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" name="presence[{{ $inscription->id }}]" class="form-check-input"
                                        {{ $inscription->presence ? 'checked' : '' }}>
                                    <label class="form-check-label">Présent</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les présences</button>
                </form>
            @else
                <p>Aucun inscrit pour le moment.</p>
            @endif
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-custom');
        buttons.forEach(function(btn) {
            btn.addEventListener('mouseover', function() {
                this.style.transform = 'translateY(-2px)';
                if (this.classList.contains('btn-primary')) {
                    this.style.boxShadow = '0 4px 8px rgba(247, 148, 29, 0.4)';
                } else if (this.classList.contains('btn-secondary')) {
                    this.style.boxShadow = '0 4px 8px rgba(108, 117, 125, 0.4)';
                } else if (this.classList.contains('btn-warning')) {
                    this.style.boxShadow = '0 4px 8px rgba(255, 193, 7, 0.4)';
                } else if (this.classList.contains('btn-danger')) {
                    this.style.boxShadow = '0 4px 8px rgba(220, 53, 69, 0.4)';
                } else if (this.classList.contains('btn-success')) {
                    this.style.boxShadow = '0 4px 8px rgba(40, 167, 69, 0.4)';
                }
            });
            btn.addEventListener('mouseout', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endsection
