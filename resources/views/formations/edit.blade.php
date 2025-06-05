@extends(view: 'layouts.appdash')

@section('title')
Modifier la formation
@endsection

@section('styles')
<style>
    .logo {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .logo-bracket {
        color: #333;
    }

    .logo-c {
        color: #333;
    }

    .logo-s {
        color: #ff8c00;
    }

    .logo-c2 {
        color: #ffedaf;
    }

    .btn-orange {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: white;
    }

    .btn-orange:hover {
        background-color: #e07e00;
        border-color: #e07e00;
        color: white;
    }

    .text-orange {
        color: #ff8c00;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ff8c00;
        box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
    }

    .form-check-input:checked {
        background-color: #ff8c00;
        border-color: #ff8c00;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="logo">
                            <span class="logo-c">C</span>
                            <span class="logo-s">S</span>
                            <span class="logo-c2">C</span>
                        </div>
                    </div>
                    <h3 class="font-weight-bold">Modifier la formation</h3>
                    <p class="text-muted">Mettez à jour les informations de la formation</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="title" value="{{ $formation->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" required>{{ $formation->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Catégorie</label>
                            <select name="category" class="form-select" required>
                                <option {{ $formation->category == 'CyberSecurity' ? 'selected' : '' }}>CyberSecurity</option>
                                <option {{ $formation->category == 'AI' ? 'selected' : '' }}>AI</option>
                                <option {{ $formation->category == 'Dev' ? 'selected' : '' }}>Dev</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="formateur_email" class="form-label">Formateur</label>
                            <input type="email" class="form-control" name="formateur_email" value="{{ $formation->formateur_email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="{{ $formation->date }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="contenu" class="form-label">Prérequis</label>
                            <textarea name="contenu" class="form-control" required>{{ $formation->contenu }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="support_course" class="form-label">Support de cours (PDF)</label>
                            <input type="file" name="support_course" id="support_course" class="form-control" accept="application/pdf">
                            <div class="form-text">
                                Format accepté : PDF (max 5MB)
                            </div>
                        </div>
                        
                        

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-orange">Mettre à jour</button>
                            <a href="{{ route('formations.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
