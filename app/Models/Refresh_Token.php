<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Refresh_Token extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'expire_time',
    ];

    public function user(): HasOne{
        return $this->hasOne(User::class, 'user_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($token){
            $token->expire_time = now()->addDay(2);
        });
    }

}
