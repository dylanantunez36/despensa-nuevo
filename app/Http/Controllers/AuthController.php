<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($request->email == "admin@gmail.com" && $request->password == "1234") {
            Session::put('admin', true);
            return redirect('/admin');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect('/login');
    }
}