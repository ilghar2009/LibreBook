<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function blogs(): BelongsToMany{
        return $this->belongsToMany(Category_conn::class,'category_conn','category_id','category_id');
    }
}
