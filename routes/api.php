<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::get('ingredients', [IngredientController::class, 'index']);
