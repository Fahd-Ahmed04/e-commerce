<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\TotalOrder;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $admins = Admin::all();
        $order_details = Order::all();
        return view('display', compact('products', 'admins', 'order_details'));
    }

    public function store(Request $request)
    {
        $order_id = OrderDetails::max('order_id') + 1;
        foreach ($request->orders as $order) {
            OrderDetails::create([
                'product_name' => $order['product_name'],
                'admin_name'   => $order['admin_name'],
                'user_name'    => $order['user_name'],
                'price'        => $order['price'],
                'amount'       => $order['amount'],
                'total_price'  => $order['price'] * $order['amount'],
                'order_id'     => $order_id,
            ]);
        }

        $order_details = Order::all();
        TotalOrder::create([
            'admin_name' => $order_details[0]['admin_name'],
            'user_name' => $order_details[0]['user_name'],
            'total_price'  => $order_details->sum(function ($item) {
                return $item->price * $item->amount;
            }),
            'total_amount' => $order_details->sum('amount'),
            'order_id' => $order_id,
        ]);
        Order::truncate();
        return redirect('/allorder');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $product = Product::where('name', $order->product_name)->firstOrFail();
        $product->amount += $order->amount;
        $product->save();
        $order->delete();
        return redirect('/order');
    }
}
