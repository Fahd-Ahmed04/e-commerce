<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $stories = Store::all();
        return view('add', compact('categories', 'stories'));
    }
    public function store(Request $request)
    {
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'store_id' => ['required'],
            'price' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'category_id' => ['required'],
        ]);
        $getNameOfProduct = Product::where('name', $request->name)->where('store_id', $request->store_id)->first();
        if ($getNameOfProduct) {
            $validation['amount'] += $getNameOfProduct->amount;
            $getNameOfProduct->update($validation);
            return redirect('/dashboard');
        }
        Product::create($validation);
        return redirect('/dashboard');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $stories = Store::all();
        return view('edit', compact('product', 'categories', 'stories'));
    }
    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $getNameOfProduct = Product::where('name', $request->name)->where('store_id', $request->store_id)->where('id', '!=', $product->id)->first();
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:255'],
            'store_id' => ['required'],
            'price' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'category_id' => ['required'],
        ]);
        if ($getNameOfProduct) {
            $validation['amount'] += $getNameOfProduct->amount;
            $product->update($validation);
            $getNameOfProduct->delete();
            return redirect('/dashboard');
        }
        $product->update($validation);
        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        return redirect('/dashboard');
    }
}
