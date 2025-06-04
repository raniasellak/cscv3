<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixCartProductSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('DROP TABLE IF EXISTS cart_product;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
} 