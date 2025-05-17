<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 

class BoutiqueController extends Controller
{
    public function index()
    {
        // Récupération de toutes les catégories
        $categories = Category::all();
        
        // Envoi des catégories à la vue
        return view('boutique.index', compact('categories'));
    }
    
     public function showByCategory($id)
    {
        // Vérification de l'existence de la catégorie
        $category = Category::findOrFail($id);

        // Récupérer les produits de cette catégorie
        $products = $category->products;

        // Rediriger vers la vue avec les produits
        return view('boutique.category', compact('category', 'products'));
    }
}
