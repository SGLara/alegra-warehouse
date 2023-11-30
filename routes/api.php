<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PurchaseIngredientHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('ingredients', [IngredientController::class, 'index']);
Route::patch('ingredients', [IngredientController::class, 'update']);
Route::get('ingredients/purchase-history', PurchaseIngredientHistoryController::class);
