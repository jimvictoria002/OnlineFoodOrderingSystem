<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function check(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt($validate)){

            $request->session()->regenerate();

            if(Auth::user()->type == 'admin'){
                return redirect('/admin/home');
            }
            return redirect('/home');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials',
        ]);
    }
}
