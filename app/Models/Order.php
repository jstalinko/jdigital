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

    public static function userLevel($user_id)
    {
        $orderByUser = self::where('user_id', $user_id)->where('status', 'paid')->get();
        // Define the spending levels
        $levels = [
            'basic' => 1000000,
            'silver' => 5000000,
            'gold' => 10000000,
            'platinum' => 20000000,
            'expert' => 100000000
        ];

        // Calculate the total spending
        $totalSpending = $orderByUser->sum('total');

        // Determine the user level based on the total spending
        $userLevel = 'basic'; // Default level

        foreach ($levels as $level => $threshold) {
            if ($totalSpending >= $threshold) {
                $userLevel = $level;
            }
        }

        return $userLevel;
    }
}
