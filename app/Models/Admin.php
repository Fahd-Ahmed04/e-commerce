<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = ['username', 'status', 'email', 'password'];
    protected $table = '_admin';
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
