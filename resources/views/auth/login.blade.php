@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <!-- Image de gauche -->
    <div class="col-md-6 d-none d-md-block">
        <img src="{{ asset('images/login.png') }}" alt="Login Image" class="img-fluid rounded">
    </div>

    <!-- Formulaire de connexion -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white text-center">
                <h4>Se connecter</h4>
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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Se connecter</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('register.form') }}" class="text-decoration-none">Pas encore inscrit ? Créer un compte</a>
            </div>
        </div>
    </div>
</div>
@endsection
