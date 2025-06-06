@extends('layouts.appdash')

@section('title', 'Modifier une Formation')

@section('content')
<style>
    body {
        background-color: #fff8f0;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #ff6600;
        text-align: center;
        margin-bottom: 30px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #ffcc99;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(255, 102, 0, 0.1);
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }

    .form-label.required:after {
        content: " *";
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ffcc99;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 15px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #ff6600;
        outline: none;
        box-shadow: 0 0 5px rgba(255, 102, 0, 0.3);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: #ff6600;
        color: white;
        border: none;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-outline-primary {
        border: 1px solid #ff6600;
        color: #ff6600;
        background: transparent;
    }

    .btn-outline-primary:hover {
        background-color: #ff6600;
        color: white;
    }

    .form-text {
        font-size: 12px;
        color: #666;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .section-title {
        color: #ff6600;
        border-bottom: 1px solid #ffcc99;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }

    .image-preview {
        margin-top: 10px;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 3px;
    }

    .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }

    .form-col {
        flex: 1;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<div class="container">
    <h1>Modifier la Formation</h1>

    <div class="card">
        <form action="{{ route('formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data" id="formationForm">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <h5 class="section-title">Informations de base</h5>

            <div class="form-row">
                <div class="form-col">
                    <label for="title" class="form-label required">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $formation->title }}" required>
                    <div class="invalid-feedback">
                        Veuillez saisir un titre pour la formation.
                    </div>
                </div>
                
                <div class="form-col">
                    <label for="category" class="form-label required">Catégorie</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="CyberSecurity" {{ $formation->category == 'CyberSecurity' ? 'selected' : '' }}>CyberSecurity</option>
                        <option value="AI" {{ $formation->category == 'AI' ? 'selected' : '' }}>AI</option>
                        <option value="Dev" {{ $formation->category == 'Dev' ? 'selected' : '' }}>Dev</option>
                    </select>
                    <div class="invalid-feedback">
                        Veuillez sélectionner une catégorie.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label required">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control" required>{{ $formation->description }}</textarea>
                <div class="invalid-feedback">
                    Veuillez saisir une description.
                </div>
            </div>

            <!-- Instructor and Schedule Section -->
            <h5 class="section-title">Formateur et planning</h5>

            <div class="form-row">
                <div class="form-col">
                    <label for="formateur_email" class="form-label required">Email du formateur</label>
                    <input type="email" name="formateur_email" id="formateur_email" class="form-control" value="{{ $formation->formateur_email }}" required>
                    <div class="invalid-feedback">
                        Veuillez saisir un email valide.
                    </div>
                </div>
                
                <div class="form-col">
                    <label for="date" class="form-label required">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $formation->date }}" required>
                    <div class="invalid-feedback">
                        Veuillez sélectionner une date valide.
                    </div>
                </div>
            </div>

            <!-- Resources Section -->
            <h5 class="section-title">Ressources</h5>

            <div class="form-row">
                <div class="form-col">
                    <label for="recording" class="form-label">Lien d'enregistrement</label>
                    <input type="url" name="recording" id="recording" class="form-control" value="{{ $formation->recording }}">
                    <div class="form-text">
                        URL de la vidéo d'enregistrement (YouTube, Vimeo, etc.)
                    </div>
                </div>
                
                <div class="form-col">
                    <label for="support_course" class="form-label">Support de cours</label>
                    <input type="file" name="support_course" id="support_course" class="form-control" accept="application/pdf">
                    <div class="form-text">
                        Format accepté : PDF (max 5MB)
                    </div>
                    @if($formation->support_course)
                    <div class="form-text">
                        Fichier actuel : <a href="{{ asset('storage/' . $formation->support_course) }}" target="_blank">Télécharger</a>
                    </div>
                    @endif
                    <div id="pdf-preview" class="form-text"></div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <h5 class="section-title">Informations complémentaires</h5>

            <div class="mb-3">
                <label for="contenu" class="form-label">Prérequis</label>
                <textarea name="contenu" id="contenu" rows="3" class="form-control">{{ $formation->contenu }}</textarea>
                <div class="form-text">
                    Liste des connaissances requises pour cette formation
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('formations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aperçu de la formation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="preview-content">
                <!-- Preview content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // PDF preview filename display
    document.getElementById('support_course').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('pdf-preview');
        
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                alert('La taille du fichier ne doit pas dépasser 5MB');
                this.value = '';
                preview.textContent = '';
                return;
            }
            
            preview.textContent = `Nouveau fichier sélectionné : ${file.name}`;
        } else {
            preview.textContent = '';
        }
    });

    // Form submission
    document.getElementById('formationForm').addEventListener('submit', function(e) {
        // Add form validation
        this.classList.add('was-validated');
        
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
</script>
@endsection