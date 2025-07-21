<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();
        return view('users', compact('users'))->with(['errormessage'=>"Enter correct data"]);
    }
    public function index()
    {
        return view('adduser')->with(['errormessage'=>"Enter correct data"]);
    }
    public function store()
    {
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:100'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)]
        ]);
        $validation['password'] = Hash::make($validation['password']);
        User::create($validation);
        return redirect('users');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edituser', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $validation = request()->validate([
            'name' => ['required', 'regex:/^[\p{Arabic}\- ]+$/u', 'max:100', 'min:3'],
            'email' => ['required','email',Rule::unique('users', 'email')->ignore($user->id),],
            'password' => ['required', Password::min(6)],
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $user->update($validation);        
        return redirect('/users');
    }
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }
}
