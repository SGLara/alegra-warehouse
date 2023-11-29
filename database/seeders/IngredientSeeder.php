<?php

namespace Database\seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingredient::factory()->create([
            'name' => 'tomato',
        ]);

        Ingredient::factory()->create([
            'name' => 'lemon',
        ]);

        Ingredient::factory()->create([
            'name' => 'potato',
        ]);

        Ingredient::factory()->create([
            'name' => 'rice',
        ]);

        Ingredient::factory()->create([
            'name' => 'ketchup',
        ]);

        Ingredient::factory()->create([
            'name' => 'lettuce',
        ]);

        Ingredient::factory()->create([
            'name' => 'onion',
        ]);

        Ingredient::factory()->create([
            'name' => 'cheese',
        ]);

        Ingredient::factory()->create([
            'name' => 'meat',
        ]);

        Ingredient::factory()->create([
            'name' => 'chicken',
        ]);
    }
}
