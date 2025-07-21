<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{    
    public function index()
    {
        $stories = Store::all();
        return view('store', compact('stories'));
    }
    public function create()
    {
        return view('addstore');
    }
    public function store()
    {
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:100'],
        ]);
        Store::create($validation);
        return redirect('/store');
    }
    public function show($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('store_id', $store->id)->get();
        return view('showDetails', compact('store', 'products'));
    }
}
