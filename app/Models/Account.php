<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'account',
        'uuid',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
