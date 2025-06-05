@extends('layouts.appdash')

@section('content')
<style>
    body {
        background-color: #fff8f0;
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #ff6600;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        background-color: #ffffff;
        border: 1px solid #ffcc99;
        border-radius: 10px;
        padding: 30px;
        max-width: 500px;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(255, 102, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 15px;
        color: #333;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ffcc99;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 5px;
    }

    button {
        background-color: #ff6600;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #e65c00;
    }
</style>

<h2>Ajouter un membre</h2>
<form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" id="memberForm">
    @csrf
    <label>Nom :
        <input type="text" name="name" required>
    </label>
    <label>Rôle :
        <input type="text" name="role" required>
    </label>
    <label>Description :
        <textarea name="description" required></textarea>
    </label>
    <label>Image :
        <input type="file" name="image" accept="image/*">
    </label>
    <button type="submit">Ajouter</button>
</form>

<script>
    // Message de confirmation JavaScript
    document.getElementById('memberForm').addEventListener('submit', function (e) {
        const confirmed = confirm("Es-tu sûr(e) de vouloir ajouter ce membre ?");
        if (!confirmed) {
            e.preventDefault(); // annule l'envoi du formulaire
        }
    });
</script>
@endsection
