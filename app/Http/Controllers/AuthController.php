<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function show()
    {
        if (!Auth::check()) {
            return view('login');
        }

        return redirect('/');
    }

    public function login(Request $request)
    {
        if (!Auth::check()) {
            $usuario = Usuario::firstWhere('usuario', $request->usuario);
     
            if ($usuario && $usuario->clave == $request->clave) {
                Auth::login($usuario);
    
                return redirect('/');
            }
     
            return back()
                ->withInput()
                ->with('error', 'Usuario o contraseña incorrectos');
        }

        return redirect('/');
    }

    public function logout()
    {
        if (!Auth::check()) {
            return redirect('/login')
                ->with('error', 'Debe iniciar sesión primero');
        }
        
        Auth::logout();

        return redirect('/login');
    }
}
