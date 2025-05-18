<?php

namespace App\Http\Controllers;
use PDF; // alias pour Barryvdh\DomPDF\Facade\Pdf

use App\Models\Inscription;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    public function generate(Inscription $inscription)
    {
        $formation = $inscription->formation;

        // Vérification simple sans date (comme demandé)
        if (!$inscription->presence) {
            abort(403, "L'attestation n'est pas disponible.");
        }

        $data = [
            'nom' => $inscription->nom,
            'formation' => $formation->titre,
        ];

        // Génération PDF à partir d'une vue
        $pdf = PDF::loadView('attestation.pdf', $data);

        // Retourner le PDF en téléchargement
        return $pdf->download('attestation.pdf');
    }



}
