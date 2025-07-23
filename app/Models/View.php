<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable= [
        'blog_id',
        'user_id',
        'number',
        'ip',
    ];
}
