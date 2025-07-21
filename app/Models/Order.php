<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['admin_name', 'product_name', 'price', 'amount', 'total_price', 'user_name'];
    protected $table = 'orders';
}
