<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN'])) {
            $transportes = Transporte::orderBy('modelo')->paginate(15);
        } else {
            $transportes = Transporte::with('chofer')
                ->whereRelation('chofer', 'sucursal_id', Auth::user()->empleado->sucursal_id)
                ->orderBy('modelo')
                ->paginate(15);
        }

        return view('transportes.list', [
            'transportes' => $transportes
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
            $choferes = Empleado::with('rol')
                ->whereRelation('rol', 'nombre', 'CHOFER')
                ->orderBy('nombre')
                ->get();
        } else {
            $choferes = Empleado::with('rol')
                ->where('sucursal_id', Auth::user()->empleado->sucursal_id)
                ->whereRelation('rol', 'nombre', 'CHOFER')
                ->orderBy('nombre')
                ->get();
        }

        return view('transportes.create', [
            'choferes' => $choferes
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
        $placa = strtoupper($request->placa);

        $chofer = Empleado::find($request->chofer);

        if (is_null($chofer) || $chofer->rol->nombre != 'CHOFER') {
            return back()
                ->withInput()
                ->with('error', 'El chofer seleccionado no se encuentra en los registros');
        }

        $transporte = Transporte::firstWhere('placa', $placa);

        if (!is_null($transporte)) {
            return back()
                ->withInput()
                ->with('error', 'El transporte con placa '.$placa.' ya se encuentra registrado');
        }

        $transporte = Transporte::withTrashed()->firstWhere('placa', $placa);
        
        if (is_null($transporte)) {
            $transporte = new Transporte;
            $transporte->marca = $request->marca;
            $transporte->modelo = $request->modelo;
            $transporte->placa = $placa;
            $transporte->chofer_id = $request->chofer;
            $transporte->save();

            return redirect('/transportes')
                ->with('success', 'El transporte con placa '.$transporte->placa.' fue creado satisfactoriamente');
        }

        if (!is_null($transporte->deleted_at)) {
            $transporte->restore();
            $transporte->chofer_id = $request->chofer;
            $transporte->save();

            return redirect('/transportes')
                ->with('success', 'El transporte con placa '.$placa.' fue creado satisfactoriamente');
        }

        return back()
            ->withInput()
            ->with('error', 'El transporte con placa '.$placa.' ya se encuentra registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transporte = Transporte::find($id);

        if (is_null($transporte)) {
            return redirect('/transportes')
                ->with('error', 'El transporte que busca no existe');
        }

        return view('transportes.show', [
            'transporte' => $transporte
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transporte = Transporte::find($id);

        if (is_null($transporte)) {
            return redirect('/transportes')
                ->with('error', 'El transporte que busca no existe');
        }

        if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN'])) {
            $choferes = Empleado::with('rol')
                ->whereRelation('rol', 'nombre', 'CHOFER')
                ->orderBy('nombre')
                ->get();
        } else {
            $choferes = Empleado::with('rol')
                ->where('sucursal_id', Auth::user()->empleado->sucursal_id)
                ->whereRelation('rol', 'nombre', 'CHOFER')
                ->orderBy('nombre')
                ->get();
        }

        return view('transportes.edit', [
            'transporte' => $transporte,
            'choferes' => $choferes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $placa = strtoupper($request->placa);

        $transporte = Transporte::find($id);

        if (is_null($transporte)) {
            return redirect('/transportes')
                ->with('error', 'El transporte que busca no existe');
        }

        $empleado = Empleado::find($request->chofer);

        if (is_null($empleado) || $empleado->rol->nombre != 'CHOFER') {
            return back()
                ->withInput()
                ->with('error', 'El chofer seleccionado no se encuentra en los registros');
        }

        $transporteE = Transporte::firstWhere('placa', $placa);

        if (!is_null($transporteE) && $transporteE->id != $id) {
            return back()
                ->withInput()
                ->with('error', 'El transporte con placa '.$placa.' ya se encuentra registrado');
        }

        $transporte->marca = $request->marca;
        $transporte->modelo = $request->modelo;
        $transporte->placa = $placa;
        $transporte->chofer_id = $request->chofer;
        $transporte->save();

        return redirect('/transportes')
            ->with('success', 'El transporte con placa '.$transporte->placa.' fue actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transporte = Transporte::find($id);

        if (!is_null($transporte)) {
            $transporte->delete();

            return redirect('/transportes')->with('success', 'El transporte con placa '.$transporte->placa.' fue eliminado satisfactoriamente');
        }

        return redirect('/transportes')->with('error', 'El transporte que busca no existe');
    }
}
