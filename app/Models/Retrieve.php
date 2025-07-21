<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retrieve extends Model
{
    protected $table = '_retrieves';
    protected $fillable = ['admin_name', 'product_name', 'price', 'amount', 'amount_before', 'amount_after'];
}
