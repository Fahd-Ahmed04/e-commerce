<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category', ['category' => Category::all()]);
    }
    public function create()
    {
        return view('addcategory');
    }
    public function store()
    {
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:25'],
        ]);
        $category = Category::create($validation);
        return redirect('/category');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('editcategory', compact('category'));
    }
    public function update(Category $category)
    {
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u'],
        ]);
        $category->update($validation);
        return redirect('/category');
    }
    public function destroy($id)
    {
        $category = Category::where('id', $id)->delete();
        $product = Product::where('category_id', $id)->delete();
        return redirect('/category');
    }
}
