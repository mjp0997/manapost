<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Estado;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::orderBy('nombre')->get();

        return view('ciudades.list', [
            'ciudades' => $ciudades
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::orderBy('nombre')->get();

        return view('ciudades.create', [
            'estados' => $estados
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
        $estado = Estado::find($request->estado);

        if (is_null($estado)) {
            return back()
                ->withInput()
                ->with('error', 'El estado seleccionado no se encuentra en los registros');
        }

        $ciudad = Ciudad::withTrashed()->firstWhere([
            ['nombre', $request->nombre],
            ['estado_id', $request->estado]
        ]);
        
        if (is_null($ciudad)) {
            $ciudad = new Ciudad;
            $ciudad->nombre = $request->nombre;
            $ciudad->estado_id = $request->estado;
            $ciudad->save();

            return redirect('/ciudades')
                ->with('success', 'La ciudad '.$ciudad->nombre.' fue creada satisfactoriamente');
        }

        if (!is_null($ciudad->deleted_at)) {
            $ciudad->restore();

            return redirect('/ciudades')
                ->with('success', 'La ciudad '.$ciudad->nombre.' fue creada satisfactoriamente');
        }

        return back()
            ->withInput()
            ->with('error', 'La ciudad '.$request->nombre.' ya se encuentra registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ciudad = Ciudad::find($id);

        if (is_null($ciudad)) {
            return redirect('/ciudades')
                ->with('error', 'La ciudad que busca no existe');
        }

        return view('ciudades.show', [
            'ciudad' => $ciudad
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciudad = Ciudad::find($id);

        $estados = Estado::orderBy('nombre')->get();

        if (is_null($ciudad)) {
            return redirect('/ciudades')
                ->with('error', 'La ciudad que busca no existe');
        }

        return view('ciudades.edit', [
            'ciudad' => $ciudad,
            'estados' => $estados
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ciudad = Ciudad::find($id);

        if (is_null($ciudad)) {
            return redirect('/ciudades')
                ->with('error', 'La ciudad que busca no existe');
        }

        $estado = Estado::find($request->estado);

        if (is_null($estado)) {
            return back()
                ->withInput()
                ->with('error', 'El estado seleccionado no se encuentra en los registros');
        }

        $ciudadE = Ciudad::withTrashed()->firstWhere('nombre', $request->nombre);
        
        if (!is_null($ciudadE) && $ciudadE->id != $id) {
            return back()
                ->withInput()
                ->with('error', 'La ciudad '.$request->nombre.' ya se encuentra registrada');
        }
        
        $ciudad->nombre = $request->nombre;
        $ciudad->estado_id = $request->estado;
        $ciudad->save();

        return redirect('/ciudades')
            ->with('success', 'La ciudad '.$ciudad->nombre.' fue actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ciudad = Ciudad::find($id);

        if (!is_null($ciudad)) {
            $ciudad->delete();

            return redirect('/ciudades')->with('success', 'La ciudad '.$ciudad->nombre.' fue eliminada satisfactoriamente');
        }

        return redirect('/ciudades')->with('error', 'La ciudad que busca no existe');

    }
}
