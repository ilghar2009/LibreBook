<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable=[
        'blog_id',
        'user_id',
        'is_like',
        'ip',
    ];
}
