<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->paginate(1); // Correction ici
        return view('admin.products.index', compact('products')); // Correction ici
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        return view('admin.products.create', compact('product')); // Correction ici
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(ProductRequest $request) {
    // Validate the request data
    $formFields = $request->validated();
    
    // Check if an image file is uploaded
    if ($request->hasFile('image')) {
        // Store the image in the 'public/product' directory
        $formFields['image'] = $request->file('image')->store('product', 'public');
    }
    
    // Create the product in the database
    Product::create($formFields);
    
    // Redirect back to the product list with a success message
    return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès.');
}


    

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product->update($formFields);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
