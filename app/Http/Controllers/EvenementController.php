<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Evenement;  // <-- ceci est indispensable !

use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
{
    $evenements = Evenement::orderBy('date', 'desc')->get();
    return view('evenements.index', compact('evenements'));
}

    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        return view('evenements.create');
        }


    // Sinon : accès refusé
    abort(403, 'Accès refusé');
    }

    public function store(Request $request)
{
   $request->validate([
    'titre' => 'required|string|max:255',
    'lieu' => 'nullable|string|max:255',
    'date' => 'required|date',
    'description' => 'nullable|string',
    'long_description' => 'nullable|string',
    'agenda' => 'required|json',
]);

Evenement::create([
    'titre' => $request->titre,
    'lieu' => $request->lieu,
    'date' => $request->date,
    'description' => $request->description,
    'long_description' => $request->long_description,
    'agenda' => $request->agenda,
]);


    return redirect()->route('evenements.index')->with('success', 'Événement créé.');
}



public function show(Evenement $evenement)
{
    $agenda = json_decode($evenement->agenda, true) ?? [];

    return view('evenements.show', [
        'evenement' => $evenement,
        'agenda' => $agenda,
    ]);
}
public function edit(Evenement $evenement)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        $agenda = json_decode($evenement->agenda, true); // Décoder le JSON
        return view('evenements.edit', compact('evenement', 'agenda'));
        }
        // Sinon : accès refusé
    abort(403, 'Accès refusé');
    
    }

    // Met à jour les données dans la base
    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'lieu' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'agenda' => 'nullable|json',
        ]);

        $evenement->update([
            'titre' => $request->titre,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'description' => $request->description,
            'long_description' => $request->long_description,
            'agenda' => $request->agenda,
        ]);

        return redirect()->route('evenements.show', $evenement)->with('success', 'Événement mis à jour.');
    }
    public function destroy(Evenement $evenement)
{
    if (Auth::check() && Auth::user()->role === 'admin') {
    $evenement->delete();
    return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès.');
    }
    // Sinon : accès refusé
    abort(403, 'Accès refusé');
    
}



}
