<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $id
 * @property string $name
 * @property int $available_units
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Ingredient extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'available_units',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    protected $attributes = [
        'available_units' => 5,
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
    // public function relation(): BelongsToMany

    /*
    |--------------------------------------------------------------------------
    | Other Methods
    |--------------------------------------------------------------------------
    */
}
