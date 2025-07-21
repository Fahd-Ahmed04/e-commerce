<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier', compact('suppliers'));
    }
    public function create()
    {
        return view('addsuplier');
    }
    public function store()
    {
        $validation = request()->validate([
            'name'     => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:100'],
            'phone'    => ['required', 'numeric'],
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        $validation['password'] = Hash::make($validation['password']);
        Supplier::create($validation);
        return redirect('/supplier');
    }
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('editsuplier', compact('supplier'));
    }
    public function update(Request $request)
    {
        $supplier = Supplier::findOrFail($request->id);
        $validation = $request->validate([
            'name'     => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:100'],
            'password' => ['required'],
            'email'    => ['required', 'email'],
            'phone'    => ['required', 'numeric'],
        ]);
        $supplier->update($validation);
        return redirect('/supplier');
    }
    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return back();
    }
}
