<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $aux = $this->usuarioAuxiliar();
            
            if (!$aux) {
                $usuario = Usuario::firstWhere('usuario', $request->usuario);
         
                if ($usuario && Hash::check($request->clave, $usuario->clave)) {
                    Auth::login($usuario);
        
                    return redirect('/');
                }
         
                return back()
                    ->withInput()
                    ->with('error', 'Usuario o contraseña incorrectos');
            }

            Auth::login($aux);
        
            return redirect('/');
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

    private function usuarioAuxiliar()
    {
        $usuarios = Usuario::all();

        if (count($usuarios) == 0) {
            $rol = Rol::firstWhere('nombre', 'DEV');

            if (!$rol) {
                $rol = new Rol();
                $rol->nombre = 'DEV';
                $rol->save();
            }

            $empleado = new Empleado();
            $empleado->nombre = 'DEV';
            $empleado->cedula = '-';
            $empleado->direccion = '';
            $empleado->fecha_nacimiento = date_create(date('Y-m-d'));
            $empleado->rol_id = $rol->id;
            $empleado->save();

            $usuario = new Usuario();
            $usuario->usuario = 'dev-master';
            $usuario->clave = Hash::make('dev-master1');
            $usuario->empleado_id = $empleado->id;
            $usuario->save();

            return $usuario;
        }

        return false;
    }
}
