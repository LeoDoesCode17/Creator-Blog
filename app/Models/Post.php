<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'cover',
        'author_id',
        'category_id',
        'soft_deleted',
    ];

    //relation with user table
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relation with category table
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
