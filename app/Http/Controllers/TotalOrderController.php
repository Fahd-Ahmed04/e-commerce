<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Retrieve;
use App\Models\TotalOrder;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TotalOrderController extends Controller
{
    public function show($id)
    {
        $total_order = OrderDetails::where('order_id', $id)->get();
        $orders = TotalOrder::where('id', $id)->first();
        return view('show', compact('total_order', 'orders', 'id'));
    }
    public function replace($id)
    {
        $order = OrderDetails::findOrFail($id);
        $orderDetails = OrderDetails::where('order_id', $order->order_id)->first();
        $products = Product::all();
        $users = User::all();
        $stores = Store::all();
        return view('replace', compact('products', 'order',  'orderDetails', 'users', 'stores'));
    }
    public function update(Request $request)
    {
        $order = OrderDetails::findOrFail($request->id);
        $product = Product::where('name', $order->product_name)->first();

        $product->amount += $order->amount;
        $product->save();

        if ($product->amount < $request->amount) {
            return back()->with('error', 'This amount isn\'t enough');
        }
        $pro = Product::findOrFail($request->product_name);
        $validation = $request->validate([
            'admin_name'   => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'user_name'    => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'price'        => ['required', 'numeric'],
            'amount'       => ['required', 'numeric'],
        ]);
        $total_order = OrderDetails::where('order_id', $order->order_id)->get();
        $order->update([
            'admin_name' => $request->admin_name,
            'user_name' => $request->user_name,
            'product_name' => $pro->name,
            'price' => $pro->price,
            'amount' => $request->amount,
            'order_id' => $total_order[0]['order_id'],
            'total_price' => $pro->price * $request->amount,
        ]);

        $pro->amount -= $request->amount;
        $pro->save();
        return redirect()->route('show-order', $order->order_id)->with('success', 'تم التحديث بنجاح');
    }
    public function destroy($id)
    {
        $totalOrder = TotalOrder::findOrFail($id);
        $orderDetails = OrderDetails::where('order_id', $totalOrder->order_id)->get();

        foreach ($orderDetails as $order) {
            $product = Product::where('name', $order->product_name)->first();
            if ($product) {
                $product->amount += $order->amount;
                $product->save();
            }
            Retrieve::create([
                'admin_name' => $order->admin_name,
                'product_name' => $order->product_name,
                'price' => $order->price,
                'amount' => $order->amount,
                'amount_before' => $product->amount - $order->amount,
                'amount_after' => $product->amount,
            ]);
        }
        $totalOrder['status'] = 'retrieve';
        $totalOrder->save();
        return back();
    }
}
