<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
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
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .image {
            text-align: center;
            margin: 20px 0;
        }
        .image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Newsletter</p>
    </div>

    <div class="content">
        <div style="white-space: pre-line;">{{ $content }}</div>
        
        @if($imagePath)
            <div class="image">
                <img src="{{ config('app.url') }}/storage/{{ $imagePath }}" alt="Image newsletter">
            </div>
        @endif
    </div>
    

    <div class="footer">
        <p>Vous recevez cet email car vous êtes abonné à notre newsletter.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
    </div>
</body>
</html>