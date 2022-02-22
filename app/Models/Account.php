<?php

namespace App\Models;

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

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
