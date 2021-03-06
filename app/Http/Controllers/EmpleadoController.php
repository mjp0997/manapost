<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Rol;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN'])) {
            $empleados = Empleado::with('rol')
                ->whereRelation('rol', 'nombre', '!=', 'DEV')
                ->orderBy('nombre')
                ->paginate(15);
        } else {
            $empleados = Empleado::with('rol')
                ->where('sucursal_id', Auth::user()->empleado->sucursal_id)
                ->whereRelation('rol', 'nombre', '!=', 'DEV')
                ->orderBy('nombre')
                ->paginate(15);
        }

        return view('empleados.list', [
            'empleados' => $empleados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN'])) {
            $roles = Rol::where('nombre', '!=', 'DEV')
                ->orderBy('nombre')
                ->get();
        } else {
            $roles = Rol::where([
                ['nombre', '!=', 'DEV'],
                ['nombre', '!=', 'ADMIN']
            ])->orderBy('nombre')->get();
        }

        $sucursales = Sucursal::orderBy('nombre')->get();

        $maxDate = date((date('Y') - 18).'-m-d');

        $minDate = date((date('Y') - 70).'-m-d');

        return view('empleados.create', [
            'roles' => $roles,
            'sucursales' => $sucursales,
            'minDate' => $minDate,
            'maxDate' => $maxDate
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
        if (!ctype_digit($request->cedula)) {
            return back()
                ->withInput()
                ->with('error', 'La c??dula debe contener solo n??meros enteros');
        }

        $rol = Rol::find($request->rol);

        if (is_null($rol)) {
            return back()
                ->withInput()
                ->with('error', 'El rol seleccionado no se encuentra en los registros');
        }

        $sucursal = Sucursal::find($request->sucursal);

        if (is_null($sucursal)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal seleccionada no se encuentra en los registros');
        }
        
        $empleado = new Empleado;
        $empleado->nombre = $request->nombre;
        $empleado->cedula = $request->cedula;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->rol_id = $request->rol;
        $empleado->sucursal_id = $request->sucursal;
        $empleado->save();

        return redirect('/empleados')
            ->with('success', 'El empleado '.$empleado->nombre.' fue registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        if (is_null($empleado)) {
            return redirect('/empleados')
                ->with('error', 'El empleado que busca no existe');
        }

        return view('empleados.show', [
            'empleado' => $empleado
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);

        if (is_null($empleado)) {
            return redirect('/empleados')
                ->with('error', 'El empleado que busca no existe');
        }

        if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN'])) {
            $roles = Rol::where('nombre', '!=', 'DEV')
                ->orderBy('nombre')
                ->get();
        } else {
            $roles = Rol::where([
                ['nombre', '!=', 'DEV'],
                ['nombre', '!=', 'ADMIN']
            ])->orderBy('nombre')->get();
        }

        $sucursales = Sucursal::orderBy('nombre')->get();

        $maxDate = date((date('Y') - 18).'-m-d');

        $minDate = date((date('Y') - 70).'-m-d');

        return view('empleados.edit', [
            'empleado' => $empleado,
            'roles' => $roles,
            'sucursales' => $sucursales,
            'minDate' => $minDate,
            'maxDate' => $maxDate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        
        if (is_null($empleado)) {
            return redirect('/empleados')
                ->with('error', 'El empleado que busca no existe');
        }
        
        if (!ctype_digit($request->cedula)) {
            return back()
                ->withInput()
                ->with('error', 'La c??dula debe contener solo n??meros enteros');
        }

        $rol = Rol::find($request->rol);

        if (is_null($rol)) {
            return back()
                ->withInput()
                ->with('error', 'El rol seleccionado no se encuentra en los registros');
        }

        $sucursal = Sucursal::find($request->sucursal);

        if (is_null($sucursal)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal seleccionada no se encuentra en los registros');
        }

        $empleado->nombre = $request->nombre;
        $empleado->cedula = $request->cedula;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->rol_id = $request->rol;
        $empleado->sucursal_id = $request->sucursal;
        $empleado->save();

        return redirect('/empleados')
            ->with('success', 'El empleado '.$empleado->nombre.' fue actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);

        if (!is_null($empleado)) {
            $empleado->delete();

            return redirect('/empleados')->with('success', 'El empleado '.$empleado->nombre.' fue eliminado satisfactoriamente');
        }

        return redirect('/empleados')->with('error', 'El empleado que busca no existe');
    }
}
