<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index(Request $request)
    {
        $categories = ['CyberSecurity', 'AI', 'Dev'];  // Liste des catégories disponibles
        $category = $request->get('category');  // Récupérer la catégorie sélectionnée
    
        // Si une catégorie est sélectionnée, on filtre les formations
        if ($category) {
            $formations = Formation::where('category', $category)->get();
        } else {
            $formations = Formation::all();  // Sinon, on récupère toutes les formations
        }
    
        return view('formations.index', compact('formations', 'categories', 'category'));
    }
    
    


    public function create()
    {
        return view('formations.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string',
        'formateur_email' => 'required|email',
        'date' => 'required|date',
        'contenu' => 'nullable|string',  // Validation du champ 'contenu'
    ]);

    Formation::create([
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'formateur_email' => $request->formateur_email,
        'date' => $request->date,
        'contenu' => $request->contenu,  // Sauvegarde du contenu
    ]);

    return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès.');
}


public function show($id)
{
$formation = Formation::with('inscriptions.user')->findOrFail($id);
    $isPassed = \Carbon\Carbon::parse($formation->date)->isPast();

    return view('formations.show', compact('formation', 'isPassed'));
}



public function destroy($id)
{
    $formation = Formation::findOrFail($id);
    $formation->delete();
    return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès.');
}

public function edit($id)
{
    $formation = Formation::findOrFail($id);
    return view('formations.edit', compact('formation'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        'formateur_email' => 'required|email',
        'date' => 'required|date',
        'contenu' => 'nullable|string',
    ]);

    $formation = Formation::findOrFail($id);
    $formation->update($request->all());

    return redirect()->route('formations.show', $id)->with('success', 'Formation mise à jour avec succès.');
}

public function updatePresence(Request $request, $formationId)
{
    $formation = Formation::findOrFail($formationId);

    foreach ($formation->inscriptions as $inscription) {
        $presence = $request->has("presence.{$inscription->id}");
        $inscription->presence = $presence;
        $inscription->save();
    }

    return back()->with('success', 'Présences mises à jour.');
}



}
