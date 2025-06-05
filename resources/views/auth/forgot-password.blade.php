@extends('layouts.applog')

@section('title', 'Mot de passe oublié')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #3d3d3d 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .auth-card {
        background: rgba(245, 245, 220, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(255, 140, 0, 0.2);
        overflow: hidden;
        max-width: 800px;
        width: 100%;
        border: 2px solid rgba(255, 140, 0, 0.3);
    }
    
    .auth-left {
        background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #f5f5dc;
        position: relative;
        overflow: hidden;
        border-right: 3px solid #ff8c00;
    }
    
    .auth-left::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,140,0,0.1)"/></svg>') repeat;
        animation: float 20s infinite linear;
    }
    
    @keyframes float {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    .illustration {
        width: 200px;
        height: 200px;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"><defs><linearGradient id="keyGlow" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23ff8c00;stop-opacity:0.8" /><stop offset="100%" style="stop-color:%23ffa500;stop-opacity:0.4" /></linearGradient></defs><rect x="80" y="120" width="140" height="60" rx="30" fill="url(%23keyGlow)"/><rect x="220" y="135" width="20" height="10" fill="%23ff8c00"/><rect x="220" y="155" width="15" height="10" fill="%23ff8c00"/><rect x="220" y="130" width="25" height="8" fill="%23ff8c00"/><circle cx="120" cy="150" r="15" fill="%231a1a1a"/><circle cx="120" cy="150" r="8" fill="%23ff8c00"/><rect x="100" y="200" width="100" height="70" rx="8" fill="%23f5f5dc"/><path d="M 100 200 L 150 235 L 200 200" stroke="%23ff8c00" stroke-width="3" fill="none"/></svg>') center/contain no-repeat;
        animation: bounce 3s ease-in-out infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .auth-right {
        padding: 60px 50px;
    }
    
    .auth-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    
    .auth-subtitle {
        color: #666;
        margin-bottom: 40px;
        font-size: 1.1rem;
        line-height: 1.6;
    }
    
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-control {
        border: 2px solid #ddd;
        border-radius: 12px;
        padding: 15px 50px 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f5f5dc;
        color: #1a1a1a;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: #ff8c00;
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.2);
        background: white;
        outline: none;
    }
    
    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #ff8c00;
        font-size: 18px;
    }
    
    .btn-reset {
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        border: none;
        border-radius: 12px;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
        cursor: pointer;
    }
    
    .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 140, 0, 0.4);
        background: linear-gradient(45deg, #ffa500, #ff8c00);
    }
    
    .btn-reset:active {
        transform: translateY(0);
    }
    
    .back-link {
        text-align: center;
        margin-top: 30px;
    }
    
    .back-link a {
        color: #ff8c00;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .back-link a:hover {
        color: #ffa500;
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
        padding: 15px 20px;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
    }
    
    .alert-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
    }
    
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .info-box {
        background: rgba(255, 140, 0, 0.1);
        border: 1px solid rgba(255, 140, 0, 0.3);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        color: #1a1a1a;
    }
    
    .info-box i {
        color: #ff8c00;
        margin-right: 10px;
    }
    
    @media (max-width: 768px) {
        .auth-left {
            display: none;
        }
        .auth-right {
            padding: 40px 30px;
        }
        .auth-title {
            font-size: 2rem;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="row g-0 h-100">
            <!-- Partie gauche avec illustration -->
            <div class="col-lg-6">
                <div class="auth-left h-100">
                    <div class="illustration"></div>
                    <h3 style="position: relative; z-index: 2; color: #ff8c00;">Récupération de mot de passe</h3>
                    <p style="position: relative; z-index: 2; opacity: 0.9;">Nous vous aiderons à récupérer l'accès à votre compte en toute sécurité.</p>
                </div>
            </div>
            
            <!-- Partie droite avec formulaire -->
            <div class="col-lg-6">
                <div class="auth-right">
                    <h2 class="auth-title">Mot de passe oublié ?</h2>
                    <p class="auth-subtitle">Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
                    
                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        Le lien de réinitialisation sera valide pendant <strong>24 heures</strong> seulement.
                    </div>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="Votre adresse email"
                                   value="{{ old('email') }}" 
                                   required>
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn-reset">
                            <i class="fas fa-paper-plane me-2"></i>
                            Envoyer le lien de réinitialisation
                        </button>
                    </form>
                    
                    <div class="back-link">
                        <a href="{{ route('login') }}">
                            <i class="fas fa-arrow-left"></i>
                            Retour à la connexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection