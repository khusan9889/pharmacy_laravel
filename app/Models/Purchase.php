<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public $fillable = [
        'vendor_id',
        'total_price',
        'user_id',
    ];

    public function paymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class);
    }
}
