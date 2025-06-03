<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf; //PDF

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
            'formation' => $formation,
            'date' => $formation->date,
        ];
        // Génération PDF à partir d'une vue
       return PDF::loadView('attestation.pdf', $data)
    ->download('attestation.pdf');





    }



}
