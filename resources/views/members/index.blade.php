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

    .add-member-btn {
        display: block;
        text-align: center;
        background-color: #ff6600;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        width: 200px;
        margin: 0 auto 30px;
        transition: background-color 0.3s;
    }

    .add-member-btn:hover {
        background-color: #e65c00;
    }

    .member-card {
        background-color: #ffffff;
        border: 1px solid #ffcc99;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(255, 102, 0, 0.1);
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .member-image {
        border-radius: 5px;
        object-fit: cover;
        width: 100px;
        height: 100px;
    }

    .member-info {
        flex: 1;
    }

    .member-name {
        color: #ff6600;
        margin: 0 0 5px 0;
    }

    .member-role {
        color: #666;
        font-style: italic;
        margin: 0 0 10px 0;
    }

    .member-description {
        color: #333;
        margin: 0 0 15px 0;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .edit-btn, .delete-btn {
        padding: 5px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        cursor: pointer;
    }

    .edit-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
    }

    .edit-btn:hover {
        background-color: #45a049;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
        border: none;
    }

    .delete-btn:hover {
        background-color: #d32f2f;
    }
</style>

<h2>Membres du club</h2>
<a href="{{ route('members.create') }}" class="add-member-btn">Ajouter un membre</a>

@foreach ($members as $member)
    <div class="member-card">
        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="member-image">
        <div class="member-info">
            <h3 class="member-name">{{ $member->name }}</h3>
            <p class="member-role">{{ $member->role }}</p>
            <p class="member-description">{{ $member->description }}</p>
            <div class="action-buttons">
                <a href="{{ route('members.edit', $member) }}" class="edit-btn">Modifier</a>
                <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection