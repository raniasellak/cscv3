@extends('layouts.applog')

@section('title', 'Connexion')

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
        max-width: 1000px;
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
        width: 300px;
        height: 300px;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
    }
    
    .person-illustration {
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><defs><linearGradient id="screenGlow" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23ff8c00;stop-opacity:0.8" /><stop offset="100%" style="stop-color:%23ffa500;stop-opacity:0.4" /></linearGradient></defs><!-- Desk --><rect x="50" y="280" width="300" height="15" rx="7" fill="%23654321"/><rect x="60" y="260" width="280" height="25" rx="12" fill="%238B4513"/><!-- Monitor --><rect x="120" y="180" width="160" height="100" rx="8" fill="%231a1a1a"/><rect x="125" y="185" width="150" height="85" rx="5" fill="%23000"/><rect x="130" y="190" width="140" height="75" fill="url(%23screenGlow)"/><!-- Code on screen --><rect x="135" y="195" width="60" height="4" fill="%23ff8c00"/><rect x="135" y="202" width="80" height="4" fill="%23f5f5dc"/><rect x="140" y="209" width="70" height="4" fill="%23ff8c00"/><rect x="135" y="216" width="90" height="4" fill="%23f5f5dc"/><rect x="140" y="223" width="50" height="4" fill="%23ff8c00"/><!-- Keyboard --><rect x="110" y="290" width="180" height="40" rx="8" fill="%232d2d2d"/><rect x="115" y="295" width="15" height="8" rx="2" fill="%23ff8c00"/><rect x="135" y="295" width="15" height="8" rx="2" fill="%23f5f5dc"/><rect x="155" y="295" width="15" height="8" rx="2" fill="%23ff8c00"/><!-- Mouse --><rect x="300" y="300" width="30" height="20" rx="10" fill="%232d2d2d"/><circle cx="315" cy="310" r="3" fill="%23ff8c00"/><!-- Books/Documentation --><rect x="80" y="220" width="25" height="60" fill="%23ff8c00"/><rect x="85" y="215" width="15" height="10" fill="%23f5f5dc"/><rect x="320" y="230" width="25" height="50" fill="%23654321"/><rect x="325" y="225" width="15" height="10" fill="%23f5f5dc"/><!-- Coffee cup --><circle cx="60" cy="250" r="12" fill="%23654321"/><rect x="55" y="245" width="10" height="20" fill="%23f5f5dc"/><rect x="48" y="252" width="5" height="3" fill="%23654321"/><!-- Binary floating --><text x="80" y="150" font-family="monospace" font-size="12" fill="%23ff8c00" opacity="0.6">101010</text><text x="280" y="160" font-family="monospace" font-size="10" fill="%23f5f5dc" opacity="0.4">011001</text><text x="150" y="140" font-family="monospace" font-size="8" fill="%23ff8c00" opacity="0.5">110110</text></svg>') center/contain no-repeat;
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
    }
    
    .form-control:focus {
        border-color: #ff8c00;
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.2);
        background: white;
    }
    
    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #ff8c00;
        font-size: 18px;
    }
    
    .btn-login {
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
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 140, 0, 0.4);
        background: linear-gradient(45deg, #ffa500, #ff8c00);
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .social-login {
        margin-top: 30px;
        text-align: center;
    }
    
    .social-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        margin: 0 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    
    .social-btn.facebook { background: #1a1a1a; }
    .social-btn.twitter { background: #2d2d2d; }
    .social-btn.google { background: #ff8c00; }
    
    .social-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .auth-link {
        text-align: center;
        margin-top: 30px;
    }
    
    .auth-link a {
        color: #ff8c00;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .auth-link a:hover {
        color: #ffa500;
    }
    
    .forgot-password {
        text-align: right;
        margin-bottom: 20px;
        margin-top: -10px;
    }
    
    .forgot-password a {
        color: #ff8c00;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }
    
    .forgot-password a:hover {
        color: #ffa500;
        text-decoration: underline;
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
    }
    
    .alert-success {
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        color: white;
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
                    <div class="illustration">
                        <div class="person-illustration"></div>
                    </div>
                    <h3 style="position: relative; z-index: 2; color: #ff8c00;">Bienvenue au Computer Science Club !</h3>
                    <p style="position: relative; z-index: 2; opacity: 0.9;">Connectez-vous à votre espace de savoir,d'innovation et de partage. </p>
                </div>
            </div>
            
            <!-- Partie droite avec formulaire -->
            <div class="col-lg-6">
                <div class="auth-right">
                    <h2 class="auth-title">Se connecter</h2>
                    <p class="auth-subtitle">Entrez vos identifiants pour continuer</p>
                    
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
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
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

                        <div class="form-group">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="Votre mot de passe"
                                   required>
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <!-- Lien mot de passe oublié -->
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                <i class="fas fa-question-circle me-1"></i>
                                Mot de passe oublié ?
                            </a>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Se connecter
                        </button>
                    </form>
                    
                    <div class="social-login">
                        <p class="text-muted mb-3">Ou connectez-vous avec</p>
                        <button class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="social-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="social-btn google">
                            <i class="fab fa-google"></i>
                        </button>
                    </div>
                    
                    <div class="auth-link">
                        <p>Pas encore inscrit ? <a href="{{ route('register.form') }}">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection