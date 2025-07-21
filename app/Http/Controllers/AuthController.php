<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function create()
    {
        return view('login');
    }
    public function store(Request $request)
    {
        $validation = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)],
        ]);

        if (Auth::attempt($validation)) {
            $request->session()->regenerate();
            return redirect('/store');
        }
        return redirect('/')->with(['errormessage' => "Enter correct data"]);
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
