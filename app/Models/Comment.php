<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable= [
      'blog_id',
      'user_id',
      'ip',
      'comment',
    ];
}
