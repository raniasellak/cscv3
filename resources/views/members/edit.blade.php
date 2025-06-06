@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'layouts.master')


@section('content')
<style>
    body {
        background-color: #fff8f0;
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #ff6600;
        text-align: center;
        margin-bottom: 30px;
    }

    .edit-form {
        background-color: #ffffff;
        border: 1px solid #ffcc99;
        border-radius: 10px;
        padding: 30px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(255, 102, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ffcc99;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: #ff6600;
        outline: none;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .current-image {
        margin: 15px 0;
    }

    .current-image img {
        border-radius: 5px;
        border: 1px solid #eee;
    }

    .update-btn {
        background-color: #ff6600;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        display: block;
        width: 100%;
    }

    .update-btn:hover {
        background-color: #e65c00;
    }

    .cancel-link {
        display: inline-block;
        margin-top: 15px;
        color: #ff6600;
        text-decoration: none;
        text-align: center;
        width: 100%;
    }

    .cancel-link:hover {
        text-decoration: underline;
    }
</style>

<div class="edit-form">
    <h2>Modifier un membre</h2>

    <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="{{ $member->name }}" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle :</label>
            <input type="text" id="role" name="role" value="{{ $member->role }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" required>{{ $member->description }}</textarea>
        </div>

        @if($member->image)
        <div class="form-group current-image">
            <label>Image actuelle :</label>
            <img src="{{ asset('storage/' . $member->image) }}" width="150" alt="Image actuelle">
        </div>
        @endif

        <div class="form-group">
            <label for="image">Changer l'image :</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="update-btn">Mettre à jour</button>
        <a href="{{ route('members.index') }}" class="cancel-link">Annuler</a>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        if(!confirm('Êtes-vous sûr de vouloir modifier ce membre ?')) {
            e.preventDefault();
        }
    });
</script>
@endsection