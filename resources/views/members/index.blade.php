@extends('layouts.app')

@section('content')
    <h2>Membres du club</h2>
    <a href="{{ route('members.create') }}">Ajouter un membre</a>
    @foreach ($members as $member)
        <div style="border:1px solid #ccc; margin:10px; padding:10px;">
            <img src="{{ asset('storage/' . $member->image) }}" width="80" alt="">
            <h3>{{ $member->name }} ({{ $member->role }})</h3>
            <p>{{ $member->description }}</p>
            <a href="{{ route('members.edit', $member) }}">Modifier</a>
            <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
        </div>
    @endforeach
@endsection
