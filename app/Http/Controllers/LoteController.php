<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Lote;
use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoteController extends Controller
{
    public function consignados()
    {
        $lotes = Lote::where([
            ['fecha_partida', null],
            ['fecha_arribo', null]
        ])->orderBy('created_at')->get();

        return view('lotes.list', [
            'title' => 'Lotes por despachar',
            'columnas' => ['ruta'],
            'lotes' => $lotes
        ]);
    }

    public function recibidos()
    {
        $lotes = Lote::where([
            ['fecha_partida', '!=', null],
            ['fecha_arribo', '!=', null]
        ])->orderBy('created_at')->get();

        return view('lotes.list', [
            'title' => 'Lotes recibidos',
            'columnas' => ['ruta', 'transporte', 'fecha_arribo'],
            'lotes' => $lotes
        ]);
    }

    public function despachados()
    {
        $lotes = Lote::where([
            ['fecha_partida', '!=', null],
            ['fecha_arribo', null]
        ])->orderBy('created_at')->get();

        return view('lotes.list', [
            'title' => 'Lotes despachados',
            'columnas' => ['ruta', 'transporte', 'fecha_partida'],
            'lotes' => $lotes
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lote = Lote::find($id);

        if (is_null($lote)) {
            return redirect('/lotes/recibidos')
                ->with('error', 'El lote que busca no existe');
        }

        $status;

        if (is_null($lote->fecha_partida)) {
            $status = 'Por despachar';
        } else if (is_null($lote->fecha_arribo)) {
            $status = 'despachado';
        } else {
            $status = 'entregado';
        }

        $envios = Envio::where('lote_id', $lote->id)->get();

        return view('lotes.show', [
            'lote' => $lote,
            'status' => $status,
            'envios' => $envios
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lote = Lote::find($id);

        if (is_null($lote)) {
            return redirect('/lotes/recibidos')
                ->with('error', 'El lote que busca no existe');
        }

        $transportes = Transporte::with('chofer', 'chofer.rol')
            ->whereRelation('chofer.rol', 'nombre', 'CHOFER')
            ->orderBy('nombre')
            ->get();

        return view('lotes.edit', [
            'lote' => $lote,
            'transportes' => $transportes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lote = Lote::find($id);

        if (is_null($lote)) {
            return redirect('/lotes/recibidos')
                ->with('error', 'El lote que busca no existe');
        }

        if (!is_null($lote->transporte)) {
            return redirect('/lotes/mostrar/'.$lote->id)
                ->with('error', 'El lote ya posee un transporte asignado');
        }

        $transporte = Transporte::find($request->transporte);

        if (is_null($transporte)) {
            return back()
                ->withInput()
                ->with('error', 'El transporte seleccionado no existe');
        }

        $lote->transporte_id = $transporte->id;
        $lote->save();

        return redirect('/lotes/mostrar/'.$lote->id)
            ->with('success', 'transporte asignado exitosamente');
    }

    public function recibir($id)
    {
        $lote = Lote::find($id);

        if (is_null($lote)) {
            return redirect('/lotes/consignados')
                ->with('error', 'El lote que busca no existe');
        }

        if (is_null($lote->fecha_partida)) {
            return redirect('/lotes/mostrar/'.$lote->id)
                ->with('error', 'El lote aún no ha sido marcado como despachado');
        }

        if (!is_null($lote->fecha_arribo)) {
            return redirect('/lotes/mostrar/'.$lote->id)
                ->with('error', 'El lote ya posee fecha de arribo');
        }

        $lote->fecha_arribo = DB::raw('CURRENT_TIMESTAMP');
        $lote->save();

        return redirect('/lotes/mostrar/'.$lote->id)
            ->with('success', 'Lote actualizado satisfactoriamente');
    }

    public function despachar($id)
    {
        $lote = Lote::find($id);

        if (is_null($lote)) {
            return redirect('/lotes/consignados')
                ->with('error', 'El lote que busca no existe');
        }

        if (!is_null($lote->fecha_partida)) {
            return redirect('/lotes/mostrar/'.$lote->id)
                ->with('error', 'El lote ya posee fecha de partida');
        }

        if (is_null($lote->transporte)) {
            return redirect('/lotes/mostrar/'.$lote->id)
                ->with('error', 'El lote debe tener un transporte asignado primero');
        }

        $lote->fecha_partida = DB::raw('CURRENT_TIMESTAMP');
        $lote->save();

        return redirect('/lotes/mostrar/'.$lote->id)
            ->with('success', 'Lote actualizado satisfactoriamente');
    }
}
