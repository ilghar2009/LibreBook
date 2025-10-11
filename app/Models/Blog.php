<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public function reports():HasMany
    {
        return $this->hasMany(Report::class, 'blog_id');
    }
}
