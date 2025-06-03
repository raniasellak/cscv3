@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une formation</title>
    <style>
        :root {
            --primary-color: #F7941D; /* Orange du bouton chatbot */
            --dark-bg: #212529; /* Fond noir du panneau latéral */
            --light-bg: #f8f9fa; /* Fond clair */
            --text-light: #ffffff;
            --text-dark: #333333;
            --border-radius: 4px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            background-color: var(--dark-bg);
            color: var(--text-light);
            padding: 20px 0;
            margin-bottom: 30px;
            text-align: center;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--dark-bg);
            border-left: 5px solid var(--primary-color);
            padding-left: 15px;
        }

        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            box-sizing: border-box;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(247, 148, 29, 0.2);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 12px 24px;
            cursor: pointer;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #e07e0a;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-col {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .form-col {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .form-footer {
            margin-top: 30px;
            text-align: right;
        }

        /* Ajout d'étoile pour les champs requis */
        .required::after {
            content: "*";
            color: #dc3545;
            margin-left: 4px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <h1>Plateforme de Formation CSC</h1>
        </div>
    </div>

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
                    
                    <div class="form-col">
                        <label for="support_course" class="form-label">Support de cours</label>
                        <input type="url" name="support_course" id="support_course" class="form-control">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="contenu" class="form-label required">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="5" required>{{ old('contenu') }}</textarea>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn-primary">Créer la formation</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation du bouton
            const submitBtn = document.querySelector('.btn-primary');
            submitBtn.addEventListener('mouseover', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 8px rgba(247, 148, 29, 0.4)';
            });
            
            submitBtn.addEventListener('mouseout', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
            
            // Validation de formulaire
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                let isValid = true;
                const requiredInputs = form.querySelectorAll('[required]');
                
                requiredInputs.forEach(function(input) {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.style.borderColor = '#dc3545';
                        
                        const label = document.querySelector(`label[for="${input.id}"]`);
                        if (label) {
                            label.style.color = '#dc3545';
                        }
                    }
                });
                
                if (!isValid) {
                    event.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                }
            });
            
            // Réinitialisation des couleurs lors de la saisie
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    this.style.borderColor = '';
                    
                    const label = document.querySelector(`label[for="${this.id}"]`);
                    if (label) {
                        label.style.color = '';
                    }
                });
            });
        });
    </script>
</body>
</html>
@endsection