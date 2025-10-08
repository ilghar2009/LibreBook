<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;

class Blog extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'blog_id';
    public $incrementing = false;

    protected $fillable = [
        'blog_id',
        'meta_title',
        'meta_description',
        'user_id',
        'age',
        'pdf_file',
        'contents',
        'role',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function($blog){
            $blog->blog_id = (string) \Illuminate\Support\Str::uuid();
        });
    }
}
