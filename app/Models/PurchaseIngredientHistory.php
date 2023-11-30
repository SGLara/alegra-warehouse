<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PurchaseIngredientHistory extends Model
{
    use HasFactory;

    protected $table = 'purchase_ingredient_history';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'quantity'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */
    // /** @return Attribute<string, string> */ Getter and setter
    // /** @return Attribute<string, never> */ Only getter
    // /** @return Attribute<never, string> */ Only setter
    // protected function fullName(): Attribute

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    // public function scopeActive(Builder $query): void

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    // public function relation(): BelongsTo

    /*
    |--------------------------------------------------------------------------
    | Other Methods
    |--------------------------------------------------------------------------
    */
}
