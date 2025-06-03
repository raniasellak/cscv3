<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Crée ou met à jour l'utilisateur admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );
    }
}
    

