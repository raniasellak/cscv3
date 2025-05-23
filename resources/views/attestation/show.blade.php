<!DOCTYPE html>
<html>
<head>
    <title>Attestation de formation</title>
    <style>
        body { font-family: sans-serif; padding: 40px; line-height: 1.6; }
        h1 { color: #F7941D; }
    </style>
</head>
<body>
    <h1>Attestation de participation</h1>
    <p>Nous certifions que <strong>{{ $inscription->nom ?? $inscription->user->name }}</strong>
        a bien participé à la formation <strong>"{{ $formation->title }}"</strong> 
        organisée par CSC, qui s'est déroulée le {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}.</p>

    <p>Fait le {{ now()->format('d/m/Y') }}</p>
</body>
</html>
