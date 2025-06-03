<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call AdminSeeder first
        $this->call([
            AdminSeeder::class,
        ]);

        // ✅ Vérification de l'existence de l'utilisateur avant de le créer
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // ✅ Insertion des catégories
        if (Category::count() == 0) { // Vérification si la table est vide
            Category::insert([
                ['name' => 'T-Shirt'],
                ['name' => 'Stylo'],
                ['name' => 'Agenda'],
                ['name' => 'Sac Cadeau'],
                ['name' => 'Stickers']
            ]);
        }

        // ✅ Insertion des produits
        if (Product::count() == 0) { // Vérification si la table est vide
            Product::insert([
                [
                    'name' => 'T-Shirt Blanc',
                    'description' => 'Un joli t-shirt blanc',
                    'price' => 15.99,
                    'category_id' => 1,
                    'quantity' => 10,
                    'image' => null
                ],
                [
                    'name' => 'Stylo Noir',
                    'description' => 'Stylo à encre noire',
                    'price' => 1.50,
                    'category_id' => 2,
                    'quantity' => 100,
                    'image' => null
                ],
                [
                    'name' => 'Agenda 2025',
                    'description' => 'Agenda de l\'année 2025',
                    'price' => 9.99,
                    'category_id' => 3,
                    'quantity' => 50,
                    'image' => null
                ],
                [
                    'name' => 'Sac Cadeau Rouge',
                    'description' => 'Un beau sac cadeau rouge',
                    'price' => 3.50,
                    'category_id' => 4,
                    'quantity' => 75,
                    'image' => null
                ],
                [
                    'name' => 'Sticker Cybersécurité',
                    'description' => 'Sticker avec logo de la cybersécurité',
                    'price' => 0.99,
                    'category_id' => 5,
                    'quantity' => 200,
                    'image' => null
                ]
            ]);
        }
    }
}
