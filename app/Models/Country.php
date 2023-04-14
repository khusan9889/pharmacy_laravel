<?php

namespace App\Models;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, Scopes;

    public $fillable = [
        'name',
        'code',
    ];

    public $hidden = [
        'created_at','updated_at'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
