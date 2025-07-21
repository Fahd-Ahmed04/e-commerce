<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['admin_name', 'user_name', 'product_name', 'price', 'amount', 'order_id', 'total_price'];
    protected $table = 'order_details';
}
