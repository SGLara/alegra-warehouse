<?php

namespace App\Services;

use App\Models\Ingredient;
use App\Models\PurchaseIngredientHistory;
use Illuminate\Support\Collection;

class IngredientService
{
    public function __construct(
        private MarketApiService $marketApiService
    ) {
    }

    public function buyMissingIngredients(Collection $missingIngredients): Collection
    {
        $boughtIngredients = collect();

        $missingIngredients->each(function (int $requiredAmount, string $name) use (&$boughtIngredients) {
            $currentAmount = 0;

            // Buy ingredients until the required amount is met
            while ($currentAmount < $requiredAmount) {
                $unitsBought = $this->marketApiService
                    ->buyIngredient($name)
                    ->get('quantitySold');

                // Retry until a non-zero value is returned
                while ($unitsBought === 0) {
                    $unitsBought = $this->marketApiService
                        ->buyIngredient($name)
                        ->get('quantitySold');
                }

                $currentAmount += $unitsBought;

                PurchaseIngredientHistory::create([
                    'name' => $name,
                    'quantity' => $unitsBought,
                ]);

                $boughtIngredients->put($name, $currentAmount);
            }
        });

        return $boughtIngredients;
    }

    public function updateAvailableUnits(Collection $ingredients, string $operator): void
    {
        $ingredients->each(function (int $units, string $name) use ($operator) {
            /** @var Ingredient */
            $ingredient = Ingredient::where('name', $name)->first();

            if ($operator === '+') {
                $ingredient->available_units += $units;
            } else {
                $ingredient->available_units -= $units;
            }

            $ingredient->save();
        });
    }
}
