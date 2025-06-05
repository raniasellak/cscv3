<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de votre mot de passe</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #ff8c00, #ffa500);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        
        .email-header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        
        .email-body {
            padding: 30px;
        }
        
        .email-body h2 {
            color: #ff8c00;
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        .email-body p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #ff8c00, #ffa500);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
        }
        
        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.4);
        }
        
        .warning-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .warning-box p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .email-footer p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 30px 0;
        }
        
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 5px;
            }
            
            .email-header, .email-body {
                padding: 20px;
            }
            
            .reset-button {
                display: block;
                text-align: center;
                margin: 20px 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🔐 Réinitialisation de Mot de Passe</h1>
            <p>Sécurisez votre compte en quelques clics</p>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            <h2>Bonjour {{ $user->name ?? 'Utilisateur' }} !</h2>
            
            <p>Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour créer un nouveau mot de passe sécurisé.</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="reset-button">
                    Réinitialiser mon mot de passe
                </a>
            </div>
            
            <div class="warning-box">
                <p><strong>⚠️ Important :</strong> Ce lien est valide pendant <strong>60 minutes</strong> seulement pour votre sécurité. Si vous n'avez pas demandé cette réinitialisation, ignorez simplement cet email.</p>
            </div>
            
            <div class="divider"></div>
            
            <p><strong>Conseils de sécurité :</strong></p>
            
            <ul style="color: #666; font-size: 14px; line-height: 1.8;">
                <li>Choisissez un mot de passe fort avec au moins 8 caractères</li>
                <li>Utilisez une combinaison de lettres, chiffres et symboles</li>
                <li>Ne partagez jamais votre mot de passe</li>
                <li>Activez l'authentification à deux facteurs si disponible</li>
            </ul>
            
            <p style="margin-top: 30px; font-size: 14px; color: #666;">
                Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :<br>
                <span style="word-break: break-all; color: #ff8c00;">{{ $resetUrl }}</span>
            </p>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>