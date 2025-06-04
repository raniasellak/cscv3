<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Evenement;
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
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        return view('evenements.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'lieu' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'agenda' => 'required|json',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cheminImage = null;
        if ($request->hasFile('image')) {
            $cheminImage = $request->file('image')->store('evenements', 'public');
        }

        Evenement::create([
            'titre' => $request->titre,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'description' => $request->description,
            'long_description' => $request->long_description,
            'agenda' => $request->agenda,
            'image' => $cheminImage,
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
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        $agenda = json_decode($evenement->agenda, true);
        return view('evenements.edit', compact('evenement', 'agenda'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'lieu' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'agenda' => 'nullable|json',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cheminImage = $evenement->image;

        if ($request->hasFile('image')) {
            if ($evenement->image && \Storage::disk('public')->exists($evenement->image)) {
                \Storage::disk('public')->delete($evenement->image);
            }
            $cheminImage = $request->file('image')->store('evenements', 'public');
        }

        $evenement->update([
            'titre' => $request->titre,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'description' => $request->description,
            'long_description' => $request->long_description,
            'agenda' => $request->agenda,
            'image' => $cheminImage,
        ]);

        return redirect()->route('evenements.show', $evenement)->with('success', 'Événement mis à jour.');
    }

    public function destroy(Evenement $evenement)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }

        if ($evenement->image && \Storage::disk('public')->exists($evenement->image)) {
            \Storage::disk('public')->delete($evenement->image);
        }

        $evenement->delete();

        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès.');
    }
}
