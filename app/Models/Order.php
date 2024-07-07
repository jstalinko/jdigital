<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    
    const PURCHASING_STATUS = [
        'UNPAID' => 'unpaid',
        'PAID' => 'paid',
        'FAILED' => 'cancelled',
        'EXPIRED' => 'expired',
        'REFUND' => 'cancelled',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
