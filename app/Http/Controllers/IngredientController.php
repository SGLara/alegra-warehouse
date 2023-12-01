<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use App\Services\IngredientService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IngredientController extends Controller
{
    public function __construct(
        private IngredientService $ingredientService
    ) {
    }

    public function index(IngredientRequest $request): AnonymousResourceCollection
    {
        if ($request->filled('ingredients')) {
            // verify if the ingredients are available
            $requestedIngredients = collect($request->ingredients);
            $availableIngredients = Ingredient::whereIn('name', $requestedIngredients->keys())->get();
            $availableIngredientsArray = $availableIngredients->pluck('available_units', 'name')->toArray();

            $missingIngredients = $requestedIngredients
                ->filter(function ($amount, $name) use ($availableIngredientsArray) {
                    $availableAmount = $availableIngredientsArray[$name];

                    return $amount > $availableAmount;
                })->map(function ($amount, $name) use ($availableIngredientsArray) {
                    $availableAmount = $availableIngredientsArray[$name];

                    return $amount - $availableAmount;
                });

            if ($missingIngredients->isEmpty()) {
                return IngredientResource::collection($availableIngredients);
            }

            // Buy missing ingredients and update available units
            $boughtIngredients = $this->ingredientService->buyMissingIngredients(
                $missingIngredients,
                $availableIngredientsArray
            );
            $this->ingredientService->updateAvailableUnits($boughtIngredients, '+');
        }

        return IngredientResource::collection(Ingredient::all());
    }

    public function update(IngredientRequest $request): AnonymousResourceCollection
    {
        $this->ingredientService->updateAvailableUnits(collect($request->ingredients), '-');

        return IngredientResource::collection(Ingredient::all());
    }
}
