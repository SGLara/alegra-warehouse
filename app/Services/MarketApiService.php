<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MarketApiService
{
    public function buyIngredient(string $ingredient): Collection
    {
        $response = Http::market()->get('/farmers-market/buy', ['ingredient' => $ingredient]);

        if ($response->clientError()) {
            $response->throw();
        }

        return collect($response->json());
    }
}
