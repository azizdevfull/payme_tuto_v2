<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $product = Product::create(['title' => 'Telefon', 'price' => 1000]);
        $product->orders()->create([
            'price' => $product->price,
        ]);
    }
}
