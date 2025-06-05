<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><defs><linearGradient id="lockGlow" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23ff8c00;stop-opacity:0.8" /><stop offset="100%" style="stop-color:%23ffa500;stop-opacity:0.4" /></linearGradient><linearGradient id="keyGlow" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23f5f5dc;stop-opacity:0.9" /><stop offset="100%" style="stop-color:%23ff8c00;stop-opacity:0.6" /></linearGradient></defs><!-- Shield Background --><ellipse cx="200" cy="220" rx="120" ry="140" fill="%232d2d2d" opacity="0.3"/><!-- Main Lock --><rect x="160" y="180" width="80" height="100" rx="15" fill="url(%23lockGlow)"/><!-- Lock Shackle --><path d="M 180 180 Q 180 140 200 140 Q 220 140 220 180" stroke="%23ff8c00" stroke-width="8" fill="none"/><!-- Keyhole --><circle cx="200" cy="220" r="15" fill="%231a1a1a"/><!-- Key floating --><g transform="translate(280,160) rotate(25)"><rect x="0" y="8" width="40" height="8" rx="4" fill="url(%23keyGlow)"/><rect x="35" y="0" width="8" height="8" fill="url(%23keyGlow)"/><rect x="35" y="16" width="8" height="8" fill="url(%23keyGlow)"/><circle cx="8" cy="12" r="8" fill="url(%23keyGlow)" stroke="%23ff8c00" stroke-width="2"/></g><!-- Security Patterns --><circle cx="120" cy="120" r="3" fill="%23ff8c00" opacity="0.6"><animate attributeName="opacity" values="0.3;0.8;0.3" dur="2s" repeatCount="indefinite"/></circle><circle cx="280" cy="300" r="4" fill="%23f5f5dc" opacity="0.5"><animate attributeName="opacity" values="0.2;0.7;0.2" dur="3s" repeatCount="indefinite"/></circle><circle cx="100" cy="280" r="2" fill="%23ff8c00" opacity="0.7"><animate attributeName="opacity" values="0.4;0.9;0.4" dur="1.5s" repeatCount="indefinite"/></circle><!-- Binary code streams --><text x="80" y="350" font-family="monospace" font-size="10" fill="%23ff8c00" opacity="0.4">101010</text><text x="280" y="100" font-family="monospace" font-size="8" fill="%23f5f5dc" opacity="0.3">110011</text><text x="320" y="350" font-family="monospace" font-size="12" fill="%23ff8c00" opacity="0.5">001100</text></svg>') center/contain no-repeat;
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
        
        .form-control[readonly] {
            background: #e9e9e9;
            color: #666;
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
        }
        
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 140, 0, 0.4);
            background: linear-gradient(45deg, #ffa500, #ff8c00);
        }
        
        .btn-reset:active {
            transform: translateY(0);
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
        
        .password-requirements {
            background: rgba(255, 140, 0, 0.1);
            border-left: 4px solid #ff8c00;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .password-requirements h6 {
            color: #ff8c00;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .password-requirements ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        
        .password-requirements li {
            color: #666;
            margin-bottom: 5px;
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
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="row g-0 h-100">
                <!-- Partie gauche avec illustration -->
                <div class="col-lg-6">
                    <div class="auth-left h-100">
                        <div class="illustration">
                            <div class="security-illustration"></div>
                        </div>
                        <h3 style="position: relative; z-index: 2; color: #ff8c00;">Sécurité Renforcée</h3>
                        <p style="position: relative; z-index: 2; opacity: 0.9;">Créez un nouveau mot de passe sécurisé pour protéger votre compte Computer Science Club.</p>
                    </div>
                </div>
                
                <!-- Partie droite avec formulaire -->
                <div class="col-lg-6">
                    <div class="auth-right">
                        <h2 class="auth-title">Nouveau mot de passe</h2>
                        <p class="auth-subtitle">Définissez un mot de passe sécurisé pour votre compte</p>
                        
                        <!-- Messages d'erreur -->
                        <div class="alert alert-danger" style="display: none;" id="errorAlert">
                            <ul class="mb-0" id="errorList">
                                <!-- Les erreurs seront affichées ici -->
                            </ul>
                        </div>

                        <!-- Exigences du mot de passe -->
                        <div class="password-requirements">
                            <h6><i class="fas fa-shield-alt me-2"></i>Exigences du mot de passe</h6>
                            <ul>
                                <li>Au moins 8 caractères</li>
                                <li>Une lettre majuscule et une minuscule</li>
                                <li>Au moins un chiffre</li>
                                <li>Un caractère spécial (@, #, $, etc.)</li>
                            </ul>
                        </div>

                        <!-- Formulaire de réinitialisation -->
                        <form method="POST" action="#" id="resetForm">
                            <input type="hidden" name="token" value="demo_token">

                            <!-- Email -->
                            <div class="form-group">
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control" 
                                       placeholder="Adresse email"
                                       value="user@example.com" 
                                       readonly>
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>

                            <!-- Nouveau mot de passe -->
                            <div class="form-group">
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="form-control" 
                                       placeholder="Nouveau mot de passe"
                                       required>
                                <div class="input-icon" style="cursor: pointer;" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="passwordEye"></i>
                                </div>
                            </div>

                            <!-- Confirmer mot de passe -->
                            <div class="form-group">
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       class="form-control" 
                                       placeholder="Confirmer le mot de passe"
                                       required>
                                <div class="input-icon" style="cursor: pointer;" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmationEye"></i>
                                </div>
                            </div>

                            <!-- Bouton -->
                            <button type="submit" class="btn btn-reset">
                                <i class="fas fa-check me-2"></i>
                                Réinitialiser le mot de passe
                            </button>
                        </form>

                        <!-- Retour à la connexion -->
                        <div class="auth-link">
                            <p><a href="#"><i class="fas fa-arrow-left me-1"></i> Retour à la connexion</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eye = document.getElementById(fieldId + 'Eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }

        // Validation du formulaire
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const errors = [];

            // Validation du mot de passe
            if (password.length < 8) {
                errors.push('Le mot de passe doit contenir au moins 8 caractères');
            }
            if (!/[A-Z]/.test(password)) {
                errors.push('Le mot de passe doit contenir au moins une lettre majuscule');
            }
            if (!/[a-z]/.test(password)) {
                errors.push('Le mot de passe doit contenir au moins une lettre minuscule');
            }
            if (!/[0-9]/.test(password)) {
                errors.push('Le mot de passe doit contenir au moins un chiffre');
            }
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                errors.push('Le mot de passe doit contenir au moins un caractère spécial');
            }
            if (password !== passwordConfirmation) {
                errors.push('Les mots de passe ne correspondent pas');
            }

            // Affichage des erreurs
            const errorAlert = document.getElementById('errorAlert');
            const errorList = document.getElementById('errorList');
            
            if (errors.length > 0) {
                errorList.innerHTML = errors.map(error => `<li>${error}</li>`).join('');
                errorAlert.style.display = 'block';
                errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                errorAlert.style.display = 'none';
                
                // Simulation de succès
                const successAlert = document.createElement('div');
                successAlert.className = 'alert alert-success';
                successAlert.innerHTML = '<i class="fas fa-check-circle me-2"></i>Mot de passe réinitialisé avec succès ! Redirection...';
                
                const form = document.getElementById('resetForm');
                form.parentNode.insertBefore(successAlert, form);
                
                setTimeout(() => {
                    alert('Redirection vers la page de connexion...');
                }, 2000);
            }
        });

        // Validation en temps réel
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const requirements = document.querySelectorAll('.password-requirements li');
            
            // Mise à jour visuelle des exigences
            requirements[0].style.color = password.length >= 8 ? '#28a745' : '#666';
            requirements[1].style.color = /[A-Z]/.test(password) && /[a-z]/.test(password) ? '#28a745' : '#666';
            requirements[2].style.color = /[0-9]/.test(password) ? '#28a745' : '#666';
            requirements[3].style.color = /[!@#$%^&*(),.?":{}|<>]/.test(password) ? '#28a745' : '#666';
        });
    </script>
</body>
</html>