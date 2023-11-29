<?php

namespace App\Services;

use App\Models\Ingredient;
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
                $unitsBought = $this->marketApiService->buyIngredient($name);

                // Retry until a non-zero value is returned
                while ($unitsBought->get('quantitySold') === 0) {
                    $unitsBought = $this->marketApiService->buyIngredient($name);
                }

                $currentAmount += $unitsBought->get('quantitySold');
                $boughtIngredients->put($name, $currentAmount);
            }
        });

        return $boughtIngredients;
    }

    public function updateAvailableUnits(Collection $boughtIngredients): void
    {
        $boughtIngredients->each(function (int $unitsBought, string $name) {
            /** @var Ingredient */
            $ingredient = Ingredient::where('name', $name)->first();
            $ingredient->available_units += $unitsBought;
            $ingredient->save();
        });
    }
}
