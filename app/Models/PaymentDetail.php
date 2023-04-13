<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    public $fillable = [
        'payment_method',
        'purchase_id',

    ];

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
    
}
