<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::with('empleado', 'empleado.rol')
            ->whereRelation('empleado.rol', 'nombre', '!=', 'DEV')
            ->get();

        return view('usuarios.list', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($empleado_id)
    {
        $empleado = Empleado::find($empleado_id);

        if (is_null($empleado)) {
            return redirect('/empleados')
                ->with('error', 'El empleado que busca no existe');
        }

        return view('usuarios.create', [
            'empleado' => $empleado
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auxUsuario = strtolower($request->usuario);

        $empleado = Empleado::find($request->empleado);

        if (is_null($empleado)) {
            return redirect('/empleados')
                ->with('error', 'El empleado que buscaba no existe');
        }

        if (!is_null($empleado->usuario)) {
            return back()
                ->withInput()
                ->with('error', 'El empleado con id '.$empleado->id.' ya posee un usuario');
        }

        $usuarioE = Usuario::firstWhere('usuario', $auxUsuario);

        if (!is_null($usuarioE)) {
            return back()
                ->withInput()
                ->with('error', 'El usuario '.$auxUsuario.' se encuentra ocupado');
        }

        $usuario = new Usuario();
        $usuario->usuario = $auxUsuario;
        $usuario->clave = Hash::make($request->clave);
        $usuario->empleado_id = $request->empleado;
        $usuario->save();

        return redirect('/empleados/mostrar/'.$empleado->id)
            ->with('success', 'Usuario generado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);

        if (is_null($usuario)) {
            return redirect('/usuarios')
                ->with('error', 'El usuario que busca no existe');
        }

        return view('usuarios.edit', [
            'usuario' => $usuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (is_null($usuario)) {
            return redirect('/usuarios')
                ->with('error', 'El usuario que busca no existe');
        }

        $auxUsuario = strtolower($request->usuario);

        $usuarioE = Usuario::firstWhere('usuario', $auxUsuario);

        if (!is_null($usuarioE) && $usuarioE->id != $id) {
            return back()
                ->withInput()
                ->with('error', 'El usuario '.$auxUsuario.' se encuentra ocupado');
        }

        $usuario->usuario = $auxUsuario;
        $usuario->clave = Hash::make($request->clave);
        $usuario->save();

        return redirect('/empleados/mostrar/'.$usuario->empleado->id)
            ->with('success', 'Usuario generado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!is_null($usuario)) {
            $usuario->delete();

            return redirect('/usuarios')->with('success', 'El usuario '.$usuario->usuario.' fue eliminado satisfactoriamente');
        }

        return redirect('/usuarios')->with('error', 'el usuario que busca no existe');
    }
}
