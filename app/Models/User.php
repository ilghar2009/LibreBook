<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'nickname',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = (string) Str::uuid();
        });
    }

    public function categories(): HasMany
    {
        return $this->hasmany(Category::class, 'user_id');
    }

    public function blogs(): HasMany
    {
        return $this->hasmany(Blog::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasmany(Comment::class, 'user_id');
    }

    public function reports(): HasMany
    {
        return $this->hasmany(Report::class, 'user_id');
    }

    public function token(): HasOne{
        return $this->hasOne(Token::class, 'user_id');
    }
}
