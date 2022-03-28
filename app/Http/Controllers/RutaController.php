<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutas = Ruta::all();

        return view('rutas.list', [
            'rutas' => $rutas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::all();

        return view('rutas.create', [
            'sucursales' => $sucursales
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
        if ($request->origen == $request->destino) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal de origen no puede ser la misma sucursal destino');
        }

        $origen = Sucursal::find($request->origen);

        if (is_null($origen)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal origen seleccionada no se encuentra en los registros');
        }

        $destino = Sucursal::find($request->destino);

        if (is_null($destino)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal destino seleccionada no se encuentra en los registros');
        }

        $ruta = Ruta::withTrashed()->firstWhere([
            ['origen_id', $request->origen],
            ['destino_id', $request->destino]
        ]);
        
        if (is_null($ruta)) {
            $ruta = new Ruta;
            $ruta->origen_id = $request->origen;
            $ruta->destino_id = $request->destino;
            $ruta->save();

            return redirect('/rutas')
                ->with('success', 'La ruta '.$ruta->origen->nombre.' - '.$ruta->destino->nombre.' fue creada satisfactoriamente');
        }

        if (!is_null($ruta->deleted_at)) {
            $ruta->restore();

            return redirect('/rutas')
                ->with('success', 'La ruta '.$ruta->origen->nombre.' - '.$ruta->destino->nombre.' fue creada satisfactoriamente');
        }

        return back()
            ->withInput()
            ->with('error', 'La ruta '.$ruta->origen->nombre.' - '.$ruta->destino->nombre.' ya se encuentra registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruta = Ruta::find($id);

        if (is_null($ruta)) {
            return redirect('/rutas')
                ->with('error', 'La ruta que busca no existe');
        }

        return view('rutas.show', [
            'ruta' => $ruta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruta = Ruta::find($id);

        $sucursales = Sucursal::all();

        if (is_null($ruta)) {
            return redirect('/rutas')
                ->with('error', 'La ruta que busca no existe');
        }

        return view('rutas.edit', [
            'ruta' => $ruta,
            'sucursales' => $sucursales
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->origen == $request->destino) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal de origen no puede ser la misma sucursal destino');
        }

        $origen = Sucursal::find($request->origen);

        if (is_null($origen)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal origen seleccionada no se encuentra en los registros');
        }

        $destino = Sucursal::find($request->destino);

        if (is_null($destino)) {
            return back()
                ->withInput()
                ->with('error', 'La sucursal destino seleccionada no se encuentra en los registros');
        }

        $ruta = Ruta::withTrashed()->firstWhere([
            ['origen_id', $request->origen],
            ['destino_id', $request->destino]
        ]);
        
        if (is_null($ruta)) {
            $ruta = Ruta::find($id);
            $ruta->origen_id = $request->origen;
            $ruta->destino_id = $request->destino;
            $ruta->save();

            return redirect('/rutas')
                ->with('success', 'La ruta '.$ruta->origen->nombre.' - '.$ruta->destino->nombre.' fue actualizada satisfactoriamente');
        }
        
        return back()
            ->withInput()
            ->with('error', 'La ruta '.$ruta->origen->nombre.' - '.$ruta->destino->nombre.' ya se encuentra registrada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruta = Ruta::find($id);

        if (!is_null($ruta)) {
            $ruta->delete();

            return redirect('/rutas')->with('success', 'La ruta '.$ruta->origen->nombre.' - '.$ruta->destino->nombre.' fue eliminada satisfactoriamente');
        }

        return redirect('/rutas')->with('error', 'La ruta que busca no existe');
    }
}
