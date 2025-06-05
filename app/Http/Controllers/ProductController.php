<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Afficher la liste des produits.
     */
    public function index()
    {
        $products = Product::paginate(10); // Tu peux ajuster le nombre
        return view('admin.products.index', compact('products'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * Enregistrer un nouveau produit.
     */
    public function store(ProductRequest $request)
    {
        $formFields = $request->validated();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product', 'public');
        }

        // Création du produit
        Product::create($formFields);

        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Afficher un produit spécifique.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Mettre à jour un produit existant.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $formFields = $request->validated();

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product', 'public');
        }

        $product->update($formFields);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
