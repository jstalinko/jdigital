<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'deadline',
        'min_bid',
        'max_bid',
        'deal_bid',
        'notes',
        'payment_status',
        'project_status'
    ];
}
