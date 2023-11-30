<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => IngredientController::class,
    'prefix' => 'ingredients',
], function () {
    Route::get('/', 'index');
    Route::patch('/', 'update');
});
