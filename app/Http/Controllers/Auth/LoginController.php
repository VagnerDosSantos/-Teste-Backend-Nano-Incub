<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->only('login', 'password');
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

        $guards = array_keys(Config::get('auth.guards'));
        array_pop($guards);

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($credenciais)) {
                Auth::shouldUse($guard);
                return redirect()->route('home');
            }
        }

        return back()->with('erro', 'Usuário e/ou senha estão incorretos!.',);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('logout');
    }
}
