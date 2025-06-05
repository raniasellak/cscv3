<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #fd7e14;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .info-row {
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-radius: 3px;
        }
        .label {
            font-weight: bold;
            color: #fd7e14;
        }
        .message-content {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #fd7e14;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nouveau Message de Contact</h1>
        <p>CSC University</p>
    </div>
    
    <div class="content">
        <div class="info-row">
            <span class="label">Nom:</span> {{ $name }}
        </div>
        
        <div class="info-row">
            <span class="label">Email:</span> {{ $email }}
        </div>
        
        <div class="info-row">
            <span class="label">Sujet:</span> {{ $subject }}
        </div>
        
        <div class="info-row">
            <span class="label">Date:</span> {{ date('d/m/Y H:i:s') }}
        </div>
        
        <div class="message-content">
            <div class="label">Message:</div>
            <p>{{ $messageContent }}</p>
        </div>
    </div>
    
    <div class="footer">
        <p>Ce message a été envoyé depuis le formulaire de contact du site CSC University.</p>
        <p>Vous pouvez répondre directement à cet email pour contacter {{ $name }}.</p>
    </div>
</body>
</html>