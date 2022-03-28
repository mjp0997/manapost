<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::where('nombre', '!=', 'DEV')->get();

        return view('roles.list', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rolNombre = strtoupper($request->nombre);

        $rol = Rol::withTrashed()->firstWhere('nombre', $rolNombre);
        
        if (is_null($rol)) {
            $rol = new Rol;
            $rol->nombre = $rolNombre;
            $rol->save();

            return redirect('/roles')
                ->with('success', 'El rol '.$rolNombre.' fue creado satisfactoriamente');
        }

        if (!is_null($rol->deleted_at)) {
            $rol->restore();

            return redirect('/roles')
                ->with('success', 'El rol '.$rolNombre.' fue creado satisfactoriamente');
        }

        return back()
            ->withInput()
            ->with('error', 'El rol '.$rolNombre.' ya se encuentra registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::find($id);

        if (is_null($rol)) {
            return redirect('/roles')
                ->with('error', 'El rol que busca no existe');
        }

        return view('roles.show', [
            'rol' => $rol
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::find($id);

        if (is_null($rol)) {
            return redirect('/roles')
                ->with('error', 'El rol que busca no existe');
        }

        return view('roles.edit', [
            'rol' => $rol
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rolNombre = strtoupper($request->nombre);

        $rol = Rol::withTrashed()->firstWhere('nombre', $rolNombre);
        
        if (is_null($rol)) {
            $rol = Rol::find($id);
            $rol->nombre = $rolNombre;
            $rol->save();

            return redirect('/roles')
                ->with('success', 'El rol '.$rol->nombre.' fue actualizado satisfactoriamente');
        }
        
        return back()
            ->withInput()
            ->with('error', 'El rol '.$rolNombre.' ya se encuentra registrado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);

        if (!is_null($rol)) {
            $rol->delete();
    
            return redirect('/roles')->with('success', 'El rol '.$rol->nombre.' fue eliminado satisfactoriamente');
        }

        return redirect('/roles')->with('error', 'El rol que busca no existe');
    }
}
