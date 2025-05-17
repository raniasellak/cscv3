@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <!-- Formulaire d'inscription -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4>Créer un compte</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select name="role" id="role" class="form-select">
                            <option value="user">Utilisateur</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('login.form') }}" class="text-decoration-none">Déjà un compte ? Se connecter</a>
            </div>
        </div>
    </div>

    <!-- Image de droite -->
    <div class="col-md-6 d-none d-md-block">
        <img src="{{ asset('images/login.png') }}" alt="Register Image" class="img-fluid rounded">
    </div>
</div>
@endsection
