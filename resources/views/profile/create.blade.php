@extends('layouts.master')
@section('title') add profile
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="logo">
                            
                            <span class="logo-c">C</span>
                            <span class="logo-s">S</span>
                            <span class="logo-c2">C</span>
                            
                        </div>
                    </div>
                    <h3 class="font-weight-bold">Inscription</h3>
                    <p class="text-muted">Rejoignez la communauté du Computer Science Club</p>
                </div>
                <div class="card-body">
                 <form action="{{ route('store') }}" method="POST">
    @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="nom_utilisateur" placeholder="Choisissez un nom d'utilisateur" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Téléphone (optionnel)</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Votre numéro de téléphone">
                            </div>
                            <div class="col-md-6">
                                <label for="cellule" class="form-label">Cellule préférée (optionnel)</label>
                                <select class="form-select" id="cellule" name="cellule_preferee">
                                    <option selected disabled>Sélectionnez une cellule</option>
                                    <option value="dev">Développement</option>
                        
                                    <option value="ai">Intelligence Artificielle</option>
                                    <option value="cybersec">Cybersécurité</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">Je souhaite recevoir la newsletter du club</label>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="conditions_acceptees" required>
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="#" class="text-orange">conditions d'utilisation</a> et la <a href="#" class="text-orange">politique de confidentialité</a>
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-orange btn-lg">S'inscrire</button>
                        </div>
                    </form>
                    
                     <div class="text-center mt-3">
                        <p>Déjà inscrit? <a href="{{ route('login.show') }}" class="text-orange">Se connecter</a></p>
                    </div>                    
                    
                </div>
            </div>
        </div>
    </div>
</div> 


@endsection

