<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=[
        'blog_id',
        'file',
    ];
}
