<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_conn extends Model
{
    protected $fillable = [
        'category_id',
        'blog_id',
    ];
}
