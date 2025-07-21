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
        return view('show', compact('total_order', 'id'));
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
        $total_order = OrderDetails::where('order_id', $order->order_id)->get();
        $product = Product::findOrFail($request->product_name);
        if ($product->amount < $request->amount) {
            return back()->with('error', 'This amount isn\'t enough');
        }
        $validation = $request->validate([
            'admin_name'   => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'user_name'    => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'price'        => ['required', 'numeric'],
            'amount'       => ['required', 'numeric'],
        ]);
        $validation['product_name'] = $product->name;
        $order->update($validation);
        $product->amount -= $request->amount;
        $product->save();
        return view('show', compact('total_order'));
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
