@extends('layouts.app')

@section('content')
    <h2>Modifier un membre</h2>

    <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- obligatoire pour envoyer une requête PUT -->

        <label>Nom :
            <input type="text" name="name" value="{{ $member->name }}">
        </label><br>

        <label>Rôle :
            <input type="text" name="role" value="{{ $member->role }}">
        </label><br>

        <label>Description :
            <textarea name="description">{{ $member->description }}</textarea>
        </label><br>

        <label>Image actuelle :</label><br>
        @if($member->image)
            <img src="{{ asset('storage/' . $member->image) }}" width="100"><br>
        @endif

        <label>Changer l'image :
            <input type="file" name="image">
        </label><br>

        <button type="submit">Mettre à jour</button>
    </form>
@endsection
