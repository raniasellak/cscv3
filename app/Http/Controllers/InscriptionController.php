<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InscriptionController extends Controller
{
    public function quickRegister($formationId)
    {
        $formation = Formation::findOrFail($formationId);

        if (Carbon::parse($formation->date)->isPast()) {
            return redirect()->route('formations.index')->with('error', 'La formation est déjà passée.');
        }

        $user = Auth::user(); // Utilisateur connecté

        if (Inscription::where('formation_id', $formationId)->where('user_id', $user->id)->exists()) {
            return redirect()->route('formations.index')->with('error', 'Vous êtes déjà inscrit.');
        }

        Inscription::create([
            'formation_id' => $formationId,
            'user_id' => $user->id,
            'nom' => $user->name,
            'email' => $user->email,
        ]);

        return redirect()->route('formations.index')->with('success', 'Inscription réussie.');
    }
}
    