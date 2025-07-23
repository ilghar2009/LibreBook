<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'blog_id',
        'user_id',
        'title',
        'role',
        'result',
        'age',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
