<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
    
            return redirect()->intended(route('second', ['dashboards', 'index']));
        }
    
        return back()->withErrors([
            'email' => 'هناك خطأ في بياناتك',
        ]);
    }    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout(); 

        $request->session()->invalidate(); 

        $request->session()->regenerateToken();

        return redirect('/login'); 
    }
}
