@extends('layouts.applog')

@section('title', 'Inscription')

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
    
    .security-illustration {
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><defs><linearGradient id="screenGlow" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23ff8c00;stop-opacity:0.8" /><stop offset="100%" style="stop-color:%23ffa500;stop-opacity:0.4" /></linearGradient><linearGradient id="shieldGrad" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23ff8c00" /><stop offset="100%" style="stop-color:%23ffa500" /></linearGradient></defs><!-- Central Shield --><path d="M200 80 L170 95 L170 140 Q170 180 200 200 Q230 180 230 140 L230 95 Z" fill="url(%23shieldGrad)" stroke="%23f5f5dc" stroke-width="3"/><!-- Lock inside shield --><rect x="190" y="120" width="20" height="15" rx="3" fill="%23f5f5dc"/><circle cx="200" cy="125" r="4" fill="none" stroke="%23ff8c00" stroke-width="2"/><!-- AI Brain Network --><circle cx="120" cy="150" r="8" fill="%23ff8c00" opacity="0.8"/><circle cx="280" cy="150" r="8" fill="%23ff8c00" opacity="0.8"/><circle cx="150" cy="120" r="6" fill="%23f5f5dc" opacity="0.6"/><circle cx="250" cy="120" r="6" fill="%23f5f5dc" opacity="0.6"/><circle cx="130" cy="200" r="5" fill="%23ff8c00" opacity="0.7"/><circle cx="270" cy="200" r="5" fill="%23ff8c00" opacity="0.7"/><!-- Neural connections --><line x1="120" y1="150" x2="150" y2="120" stroke="%23ff8c00" stroke-width="2" opacity="0.6"/><line x1="120" y1="150" x2="130" y2="200" stroke="%23ff8c00" stroke-width="2" opacity="0.6"/><line x1="280" y1="150" x2="250" y2="120" stroke="%23ff8c00" stroke-width="2" opacity="0.6"/><line x1="280" y1="150" x2="270" y2="200" stroke="%23ff8c00" stroke-width="2" opacity="0.6"/><line x1="150" y1="120" x2="200" y2="100" stroke="%23f5f5dc" stroke-width="2" opacity="0.4"/><line x1="250" y1="120" x2="200" y2="100" stroke="%23f5f5dc" stroke-width="2" opacity="0.4"/><!-- Multiple Monitors Setup --><rect x="80" y="250" width="60" height="40" rx="5" fill="%231a1a1a"/><rect x="85" y="255" width="50" height="30" rx="3" fill="%23000"/><rect x="87" y="257" width="46" height="26" fill="url(%23screenGlow)" opacity="0.7"/><!-- Code/Security text on screen --><rect x="90" y="260" width="20" height="2" fill="%23ff8c00"/><rect x="90" y="265" width="30" height="2" fill="%23f5f5dc"/><rect x="92" y="270" width="25" height="2" fill="%23ff8c00"/><rect x="90" y="275" width="35" height="2" fill="%23f5f5dc"/><!-- Second monitor --><rect x="150" y="245" width="70" height="45" rx="5" fill="%231a1a1a"/><rect x="155" y="250" width="60" height="35" rx="3" fill="%23000"/><rect x="157" y="252" width="56" height="31" fill="url(%23screenGlow)" opacity="0.8"/><!-- Security dashboard on main monitor --><rect x="160" y="255" width="25" height="2" fill="%23ff8c00"/><rect x="160" y="260" width="35" height="2" fill="%23f5f5dc"/><rect x="162" y="265" width="30" height="2" fill="%23ff8c00"/><rect x="160" y="270" width="40" height="2" fill="%23f5f5dc"/><rect x="162" y="275" width="20" height="2" fill="%23ff8c00"/><!-- Third monitor --><rect x="230" y="250" width="60" height="40" rx="5" fill="%231a1a1a"/><rect x="235" y="255" width="50" height="30" rx="3" fill="%23000"/><rect x="237" y="257" width="46" height="26" fill="url(%23screenGlow)" opacity="0.6"/><!-- Monitor stands --><rect x="105" y="290" width="4" height="15" fill="%232d2d2d"/><rect x="180" y="290" width="4" height="15" fill="%232d2d2d"/><rect x="255" y="290" width="4" height="15" fill="%232d2d2d"/><!-- Desk --><rect x="60" y="305" width="280" height="20" rx="10" fill="%23654321"/><!-- Security devices --><rect x="320" y="280" width="15" height="25" rx="3" fill="%232d2d2d"/><!-- Server/Router --><rect x="315" y="275" width="5" height="3" fill="%23ff8c00"/><!-- LED indicators --><circle cx="323" cy="285" r="1.5" fill="%23ff8c00"/><!-- Firewall symbol --><rect x="40" y="260" width="25" height="30" rx="5" fill="%232d2d2d"/><rect x="45" y="265" width="15" height="5" fill="%23ff8c00"/><rect x="45" y="275" width="15" height="5" fill="%23f5f5dc"/><rect x="45" y="280" width="15" height="5" fill="%23ff8c00"/><!-- Coffee (developer essential) --><circle cx="340" cy="295" r="8" fill="%23654321"/><rect x="335" y="290" width="10" height="15" fill="%23f5f5dc"/><rect x="330" y="295" width="4" height="2" fill="%23654321"/><!-- Floating security symbols --><text x="60" y="180" font-family="monospace" font-size="14" fill="%23ff8c00" opacity="0.7">🔒</text><text x="320" y="170" font-family="monospace" font-size="12" fill="%23f5f5dc" opacity="0.5">🛡️</text><text x="140" y="60" font-family="monospace" font-size="10" fill="%23ff8c00" opacity="0.6">AI</text><text x="260" y="50" font-family="monospace" font-size="8" fill="%23f5f5dc" opacity="0.4">SEC</text><!-- Binary code floating --><text x="50" y="120" font-family="monospace" font-size="8" fill="%23ff8c00" opacity="0.5">101011</text><text x="300" y="130" font-family="monospace" font-size="10" fill="%23f5f5dc" opacity="0.4">110101</text><text x="180" y="40" font-family="monospace" font-size="6" fill="%23ff8c00" opacity="0.3">010110</text></svg>') center/contain no-repeat;
        animation: pulse 4s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
    }
    
    .auth-right {
        padding: 40px 50px;
        max-height: 100vh;
        overflow-y: auto;
    }
    
    .auth-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    
    .auth-subtitle {
        color: #666;
        margin-bottom: 30px;
        font-size: 1.1rem;
    }
    
    .form-group {
        margin-bottom: 20px;
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
    
    .btn-register {
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
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 140, 0, 0.4);
        background: linear-gradient(45deg, #ffa500, #ff8c00);
    }
    
    .btn-register:active {
        transform: translateY(0);
    }
    
    .social-login {
        margin-top: 25px;
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
        margin-top: 25px;
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
    
    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 20px;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
    }
    
    .alert-success {
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        color: white;
    }
    
    .password-strength {
        margin-top: 5px;
        font-size: 12px;
    }
    
    .strength-weak { color: #dc3545; }
    .strength-medium { color: #ffc107; }
    .strength-strong { color: #28a745; }
    
    @media (max-width: 768px) {
        .auth-left {
            display: none;
        }
        .auth-right {
            padding: 30px 25px;
        }
        .auth-title {
            font-size: 2rem;
        }
        .form-group {
            margin-bottom: 18px;
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
                        <div class="security-illustration"></div>
                    </div>
                    <h3 style="position: relative; z-index: 2; color: #ff8c00;">Rejoignez-nous !</h3>
                    <p style="position: relative; z-index: 2; opacity: 0.9;">Créez votre compte, débloquez votre espace membre et commencez à coder l’avenir.</p>
                </div>
            </div>
            
            <!-- Partie droite avec formulaire -->
            <div class="col-lg-6">
                <div class="auth-right">
                    <h2 class="auth-title">Créer un compte</h2>
                    <p class="auth-subtitle">Remplissez vos informations pour commencer</p>
                    
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

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control" 
                                   placeholder="Votre nom complet"
                                   value="{{ old('name') }}" 
                                   required>
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

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
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="form-control" 
                                   placeholder="Votre numéro de téléphone"
                                   value="{{ old('phone') }}">
                            <div class="input-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="Créer un mot de passe"
                                   required>
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="password-strength" id="passwordStrength"></div>
                        </div>

                        <div class="form-group">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="form-control" 
                                   placeholder="Confirmer le mot de passe"
                                   required>
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    J'accepte les <a href="#" style="color: #ff8c00;">conditions d'utilisation</a> et la <a href="#" style="color: #ff8c00;">politique de confidentialité</a>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    Recevoir les actualités et notifications par email
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-register">
                            <i class="fas fa-user-plus me-2"></i>
                            Créer mon compte
                        </button>
                    </form>
                    
                    <div class="social-login">
                        <p class="text-muted mb-3">Ou créez un compte avec</p>
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
                        <p>Déjà inscrit ? <a href="{{ route('login.form') }}">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Script pour validation du mot de passe -->
<script>
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    
    let strength = 0;
    let feedback = '';
    
    // Critères de validation
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    switch (strength) {
        case 0:
        case 1:
        case 2:
            feedback = '❌ Mot de passe faible';
            strengthDiv.className = 'password-strength strength-weak';
            break;
        case 3:
        case 4:
            feedback = '⚠️ Mot de passe moyen';
            strengthDiv.className = 'password-strength strength-medium';
            break;
        case 5:
            feedback = '✅ Mot de passe fort';
            strengthDiv.className = 'password-strength strength-strong';
            break;
        default:
            feedback = '';
    }
    
    strengthDiv.textContent = feedback;
});
</script>

@endsection