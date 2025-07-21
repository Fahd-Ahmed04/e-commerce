<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\TotalOrder;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getByStoreJson($storeId)
    {
        $products = Product::where('store_id', $storeId)
            ->with('store') // لو عايز تستخدم اسم المخزن
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'store_name' => $product->store->name,
                ];
            });

        return response()->json($products);
    }
    public function getPrice($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['price' => $product->price]);
    }
    public function getAmount($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['quantity' => $product->amount]);
    }
    public function create()
    {
        $products = Product::all();
        $order_details = Order::all();
        $users = User::all();
        $stores = Store::all();
        return view('order', compact('products', 'order_details', 'users', 'stores'));
    }
    public function index()
    {
        $orders = TotalOrder::all();
        return view('allorder', compact('orders'));
    }
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_name);
        if ($product->amount < $request->amount) {
            return back()->with('error', 'This amount isn\'t enough');
        }
        $validation = request()->validate([
            'admin_name'   => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'user_name'    => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'price'        => ['required', 'numeric'],
            'amount'       => ['required', 'numeric'],
        ]);
        Order::create([
            'admin_name'   => $request->admin_name,
            'user_name'    => $request->user_name,
            'product_name' => $product->name,
            'price'        => $product->price,
            'amount'       => $request->amount,
            'total_price'  => $product->price * $request->amount,
        ]);
        $product->amount -= $request->amount;
        $product->save();
        return redirect('/order')->with(['errormessage' => "Enter correct data"]);
    }
}
