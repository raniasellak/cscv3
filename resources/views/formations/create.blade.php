@extends('layouts.appdash')

@section('title', 'Créer une formation')

@section('content')
<div class="container">
    <h2>Créer une nouvelle formation</h2>

    <div class="card p-4">
        <form action="{{ route('formations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-row d-flex gap-3 mb-3">
                <div class="form-col flex-fill">
                    <label for="title" class="form-label required">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                
                <div class="form-col flex-fill">
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
            
            <div class="form-row d-flex gap-3 mb-3">
                <div class="form-col flex-fill">
                    <label for="formateur_email" class="form-label required">Email du formateur</label>
                    <input type="email" name="formateur_email" id="formateur_email" class="form-control" required>
                </div>
                
                <div class="form-col flex-fill">
                    <label for="date" class="form-label required">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
            </div>
            
            <div class="form-row d-flex gap-3 mb-3">
                <div class="form-col flex-fill">
                    <label for="recording" class="form-label">Lien d'enregistrement</label>
                    <input type="url" name="recording" id="recording" class="form-control">
                </div>
                
                <div class="form-col flex-fill">
                    <label for="support_course" class="form-label">Support de cours (PDF)</label>
                    <input type="file" name="support_course" id="support_course" class="form-control" accept="application/pdf">
                    <div class="form-text">
                        Format accepté : PDF (max 5MB)
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="contenu" class="form-label">Prérequis</label>
                <textarea name="contenu" id="contenu" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Créer la formation</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.querySelector('.btn-primary');
        submitBtn.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 8px rgba(247, 148, 29, 0.4)';
        });
        
        submitBtn.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
        
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const requiredInputs = form.querySelectorAll('[required]');
            
            requiredInputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#dc3545';
                    const label = document.querySelector(`label[for="${input.id}"]`);
                    if (label) label.style.color = '#dc3545';
                }
            });
            
            if (!isValid) {
                event.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires.');
            }
        });
        
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                this.style.borderColor = '';
                const label = document.querySelector(`label[for="${this.id}"]`);
                if (label) label.style.color = '';
            });
        });
    });
</script>
@endsection
