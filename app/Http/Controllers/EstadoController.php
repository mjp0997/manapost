<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::orderBy('nombre')->paginate(15);

        return view('estados.list', [
            'estados' => $estados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estado = Estado::withTrashed()->firstWhere('nombre', $request->nombre);
        
        if (is_null($estado)) {
            $estado = new Estado;
            $estado->nombre = $request->nombre;
            $estado->save();

            return redirect('/estados')
                ->with('success', 'El estado '.$estado->nombre.' fue creado satisfactoriamente');
        }

        if (!is_null($estado->deleted_at)) {
            $estado->restore();

            return redirect('/estados')
                ->with('success', 'El estado '.$estado->nombre.' fue creado satisfactoriamente');
        }

        return back()
            ->withInput()
            ->with('error', 'El estado '.$request->nombre.' ya se encuentra registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estado = Estado::find($id);

        if (is_null($estado)) {
            return redirect('/estados')
                ->with('error', 'El estado que busca no existe');
        }

        return view('estados.show', [
            'estado' => $estado
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estado = Estado::find($id);

        if (is_null($estado)) {
            return redirect('/estados')
                ->with('error', 'El estado que busca no existe');
        }

        return view('estados.edit', [
            'estado' => $estado
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estado = Estado::find($id);

        if (is_null($estado)) {
            return redirect('/estados')
                ->with('error', 'El estado que busca no existe');
        }

        $estadoE = Estado::withTrashed()->firstWhere('nombre', $request->nombre);
        
        if (!is_null($estadoE)) {
            return back()
                ->withInput()
                ->with('error', 'El estado '.$request->nombre.' ya se encuentra registrado');
        }
        
        $estado->nombre = $request->nombre;
        $estado->save();

        return redirect('/estados')
            ->with('success', 'El estado '.$estado->nombre.' fue actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado = Estado::find($id);

        if (!is_null($estado)) {
            $estado->delete();
    
            return redirect('/estados')->with('success', 'El estado '.$estado->nombre.' fue eliminado satisfactoriamente');
        }

        return redirect('/estados')->with('error', 'El estado que busca no existe');
    }
}
