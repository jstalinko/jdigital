<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'content',
        'tags',
        'image',
        'author',
        'slug'
    ];
    protected $casts = ['tags' => 'array'];

    public static function getTags()
    {
        $allTags = collect();

        self::chunk(100, function ($posts) use (&$allTags) {
            foreach ($posts as $post) {
                $allTags = $allTags->merge($post->tags); // Assuming tags is an array
            }
        });

        $uniqueTags = $allTags->unique()->values()->all();

        return $uniqueTags;
    }
}
