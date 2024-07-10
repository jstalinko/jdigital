<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'name',
        'tags',
        'price',
        'discount',
        'description',
        'image',
        'slug',
        'active',
        'product_file',
        'product_type',
        'github_data',
        'views',
        'sold'
    ];

    protected $casts = [
        'tags' => 'array',
        'github_data' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
