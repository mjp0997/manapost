<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::all();

        return view('sucursales.list', [
            'sucursales' => $sucursales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades = Ciudad::all();

        return view('sucursales.create', [
            'ciudades' => $ciudades
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
        $ciudad = Ciudad::find($request->ciudad);

        if (is_null($ciudad)) {
            return back()
                ->withInput()
                ->with('error', 'La ciudad seleccionada no se encuentra en los registros');
        }

        $sucursal = Sucursal::withTrashed()->firstWhere([
            ['nombre', $request->nombre],
            ['ciudad_id', $request->ciudad]
        ]);
        
        if (is_null($sucursal)) {
            $sucursal = new Sucursal;
            $sucursal->nombre = $request->nombre;
            $sucursal->ciudad_id = $request->ciudad;
            $sucursal->save();

            return redirect('/sucursales')
                ->with('success', 'La sucursal '.$sucursal->nombre.' fue creada satisfactoriamente');
        }

        if (!is_null($sucursal->deleted_at)) {
            $sucursal->restore();

            return redirect('/sucursales')
                ->with('success', 'La sucursal '.$ciudad->nombre.' fue creada satisfactoriamente');
        }

        return back()
            ->withInput()
            ->with('error', 'La sucursal '.$request->nombre.' ya se encuentra registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sucursal = Sucursal::find($id);

        if (is_null($sucursal)) {
            return redirect('/sucursales')
                ->with('error', 'La sucursal que busca no existe');
        }

        return view('sucursales.show', [
            'sucursal' => $sucursal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sucursal = Sucursal::find($id);

        $ciudades = Ciudad::all();

        if (is_null($sucursal)) {
            return redirect('/sucursales')
                ->with('error', 'La sucursal que busca no existe');
        }

        return view('sucursales.edit', [
            'sucursal' => $sucursal,
            'ciudades' => $ciudades
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sucursal = Sucursal::find($id);

        if (is_null($sucursal)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal que busca no existe');
        }
        
        $ciudad = Ciudad::find($request->ciudad);
        
        if (is_null($ciudad)) {
            return back()
                ->withInput()
                ->with('error', 'La ciudad seleccionada no se encuentra en los registros');
        }

        $sucursalE = Sucursal::withTrashed()->firstWhere('nombre', $request->nombre);
        
        if (!is_null($sucursalE) && $sucursalE->id != $id) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal '.$request->nombre.' ya se encuentra registrada');
        }

        $sucursal->nombre = $request->nombre;
        $sucursal->ciudad_id = $request->ciudad;
        $sucursal->save();
        
        return redirect('/sucursales')
            ->with('success', 'La sucursal '.$sucursal->nombre.' fue actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::find($id);

        if (!is_null($sucursal)) {
            $sucursal->delete();

            return redirect('/sucursales')->with('success', 'La sucursal '.$sucursal->nombre.' fue eliminada satisfactoriamente');
        }

        return redirect('/sucursales')->with('error', 'La sucursal que busca no existe');
    }
}
