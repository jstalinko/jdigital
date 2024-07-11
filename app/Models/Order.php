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
    const PURCHASING_STATUS_TEXT = [
        'unpaid' => 'UNPAID',
        'paid' => 'PAID',
        'cancelled' => 'FAILED',
        'expired' => 'EXPIRED',
        'cancelled' => 'REFUND',
    ];
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
