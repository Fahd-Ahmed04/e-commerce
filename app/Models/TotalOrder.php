<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalOrder extends Model
{
    protected $fillable = ['admin_name', 'total_price', 'status', 'total_amount', 'order_id', 'user_name'];
    protected $table = 'total_order';
}
