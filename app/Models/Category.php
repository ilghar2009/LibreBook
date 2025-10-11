<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

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

    protected static function boot(){
        parent::boot();
        static::creating(function($category){
            $category->category_id = (string) Str::uuid();
        });
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function blogs(): HasMany{
        return $this->hasMany(Blog::class, 'category_id');
    }
}
