@extends('layouts.app')

@section('content')
    <h2>Ajouter un membre</h2>
    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nom : <input type="text" name="name"></label><br>
        <label>Rôle : <input type="text" name="role"></label><br>
        <label>Description : <textarea name="description"></textarea></label><br>
        <label>Image : <input type="file" name="image"></label><br>
        <button type="submit">Ajouter</button>
    </form>
@endsection
