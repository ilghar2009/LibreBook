<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $keytype = 'string';
    protected $primaryKey = 'category_id';
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
    ];
}
