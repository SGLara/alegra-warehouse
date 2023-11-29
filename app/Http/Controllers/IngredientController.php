<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientIndexRequest;
use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use App\Services\IngredientService;
use App\Services\MarketApiService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IngredientController extends Controller
{
    public function __construct(
        private IngredientService $ingredientService
    ) {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(IngredientIndexRequest $request)
    {
        // verify if the ingredients are available
        $requestedIngredients = collect($request->ingredients);
        $availableIngredients = Ingredient::whereIn('name', $requestedIngredients->keys())->get();
        $availableIngredientsArray = $availableIngredients->pluck('available_units', 'name')->toArray();

        $missingIngredients = $requestedIngredients
            ->filter(function ($amount, $name) use ($availableIngredientsArray) {
                $availableAmount = $availableIngredientsArray[$name];

                return $amount > $availableAmount;
            });

        if ($missingIngredients->isEmpty()) {
            return IngredientResource::collection($availableIngredients);
        }

        // Buy missing ingredients and update available units
        $boughtIngredients = $this->ingredientService->buyMissingIngredients($missingIngredients);
        $this->ingredientService->updateAvailableUnits($boughtIngredients);

        return IngredientResource::collection(Ingredient::all());
    }
}
