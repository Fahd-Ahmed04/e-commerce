<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin', [
            'admins' => Admin::all()
        ]);
    }
    public function create()
    {
        return view('addadmin');
    }
    public function store()
    {
        $validation = request()->validate([
            'username' => ['required', 'regex:/^[\p{Arabic}a-zA-Z\- ]+$/u', 'max:255'],
            'status'   => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', Password::min(6)],
        ]);

        $validation['password'] = Hash::make($validation['password']);
        Admin::create($validation);

        return redirect('/admin');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('editadmin', compact('admin'));
    }
    public function update(Admin $admin)
    {
        $validation = request()->validate([
            'username' => ['required', 'regex:/^[\p{Arabic}a-zA-Z\- ]+$/u', 'max:255'],
            'status'   => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', Password::min(6)],
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $admin->update($validation);
        return redirect('/admin');
    }
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return back();
    }
}
