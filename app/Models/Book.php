<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'date_read',
        'shelf',
        'cover',
        'rating'
    ];

    public function scopeByShelf($query, $shelf)
    {
        return $query->where('shelf', $shelf);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
