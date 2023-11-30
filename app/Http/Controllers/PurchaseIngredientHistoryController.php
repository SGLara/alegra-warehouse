<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseIngredientHistoryResource;
use App\Models\PurchaseIngredientHistory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class PurchaseIngredientHistoryController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        return PurchaseIngredientHistoryResource::collection(
            PurchaseIngredientHistory::all()
        );
    }
}
