@extends('layouts.master')

@section('title', 'Créer une formation')

@section('content')
<div class="container">
    <h2>Créer une nouvelle formation</h2>

    <div class="card">
        <form action="{{ route('formations.store') }}" method="POST">
            @csrf
            
            <div class="form-row">
                <div class="form-col">
                    <label for="title" class="form-label required">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                
                <div class="form-col">
                    <label for="category" class="form-label required">Catégorie</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="CyberSecurity">CyberSecurity</option>
                        <option value="AI">AI</option>
                        <option value="Dev">Dev</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label required">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <label for="formateur_email" class="form-label required">Email du formateur</label>
                    <input type="email" name="formateur_email" id="formateur_email" class="form-control" required>
                </div>
                
                <div class="form-col">
                    <label for="date" class="form-label required">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <label for="recording" class="form-label">Lien d'enregistrement</label>
                    <input type="url" name="recording" id="recording" class="form-control">
                </div>
                
                <div class="form-row">
                    <label for="support_course" class="form-label">Support de cours (PDF)</label>
                    <input type="file" name="support_course" id="support_course" class="form-control" accept="application/pdf">
                    <div class="form-text">
                        Format accepté : PDF (max 5MB)
                    </div>
                </div>
                
            </div>
    </div>
            
            <div class="mb-3">
                <label for="contenu" class="form-label required">Prérequis</label>
                <textarea name="contenu" id="contenu" class="form-control" rows="3" ></textarea>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn-primary">Créer la formation</button>
            </div>
        </form>
    </div>
</div>
@endsection
