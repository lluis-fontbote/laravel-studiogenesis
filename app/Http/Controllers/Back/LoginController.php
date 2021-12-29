<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {   
        if (Auth::user()) {
            if (Auth::user()->is_admin) {
                return redirect()->route('back.user.index');
            } else {
                return redirect()->route('back.category.index');
            }

        } else {
            return view('back.login');
        }
    }

    public function handleLogin(BackLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], 
                          $request->rememberMe ?? false)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('back.user.index');
            } else {
                return redirect()->route('back.category.index');
            }
            
        } else {
            return back()->withErrors(['wrongCredentials' => 'Credenciales incorrectas']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
