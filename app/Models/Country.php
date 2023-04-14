<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'code',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
