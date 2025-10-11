<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'blog_id',
        'user_id',
        'comment',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog(): BelongsTo{
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
