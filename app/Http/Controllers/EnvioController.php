<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Envio;
use App\Models\Lote;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnvioController extends Controller
{
    public function consignados()
    {
        $envios = Envio::with('lote')
            ->whereRelation('lote', 'fecha_partida', null)
            ->whereRelation('lote', 'fecha_arribo', null)
            // ->whereRelation('lote', 'transporte_id', null)
            ->get();

        return view('envios.list', [
            'title' => 'Envíos por despachar',
            'columnas' => ['fecha_consignacion', 'origen', 'destino'],
            'envios' => $envios
        ]);
    }

    public function recibidos()
    {
        $envios = Envio::with('lote')
            ->whereRelation('lote', 'fecha_partida', '!=', null)
            ->whereRelation('lote', 'fecha_arribo', '!=', null)
            ->whereRelation('lote', 'transporte_id', '!=', null)
            ->get();

        return view('envios.list', [
            'title' => 'Envíos por entregar',
            'columnas' => ['fecha_consignacion', 'origen', 'destino', 'fecha_arribo'],
            'envios' => $envios
        ]);
    }

    public function despachados()
    {
        $envios = Envio::with('lote')
            ->whereRelation('lote', 'fecha_partida', '!=', null)
            ->whereRelation('lote', 'fecha_arribo', null)
            ->whereRelation('lote', 'transporte_id', '!=', null)
            ->get();

        return view('envios.list', [
            'title' => 'Envíos despachados',
            'columnas' => ['fecha_consignacion', 'origen', 'destino'],
            'envios' => $envios
        ]);
    }

    public function entregados()
    {
        $envios = Envio::with('lote')
            ->where('fecha_retiro', '!=', null)
            ->whereRelation('lote', 'fecha_partida', '!=', null)
            ->whereRelation('lote', 'fecha_arribo', '!=', null)
            ->whereRelation('lote', 'transporte_id', '!=', null)
            ->get();

        return view('envios.list', [
            'title' => 'Envíos entregados',
            'columnas' => ['fecha_consignacion', 'fecha_retiro', 'origen', 'destino'],
            'envios' => $envios
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rutas = Ruta::all();

        return view('envios.create', [
            'rutas' => $rutas
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
        $lote = Lote::firstWhere([
            ['ruta_id', $request->ruta],
            ['fecha_partida', null]
        ]);

        if (is_null($lote)) {
            $lote = new Lote();
            $lote->ruta_id = $request->ruta;
            $lote->save();
        }

        $cliente = Cliente::firstWhere('cedula', $request->cedula_remitente);

        if (is_null($cliente)) {
            if (is_null($request->direccion_remitente)) {
                return redirect('/envios/crear')
                ->withInput()
                ->with('cliente', null)
                ->with('error_cliente', 'Cliente no registrado, ingrese sus datos');
            }

            $cliente = new Cliente();
            $cliente->cedula = $request->cedula_remitente;
            $cliente->nombre = $request->nombre_remitente;
            $cliente->direccion = $request->direccion_remitente;
            $cliente->save();
        }

        $destinatario = Cliente::firstWhere('cedula', $request->cedula_destinatario);

        if (is_null($destinatario)) {
            $destinatario = new Cliente();
            $destinatario->cedula = $request->cedula_destinatario;
            $destinatario->nombre = $request->nombre_destinatario;
            $destinatario->save();
        }

        $envio = new Envio();
        $envio->descripcion = $request->descripcion;
        $envio->peso = $request->peso;
        $envio->monto = $request->monto;
        $envio->remitente_id = $cliente->id;
        $envio->destinatario_id = $destinatario->id;
        $envio->lote_id = $lote->id;
        $envio->consignatario_id = $request->consignatario;
        $envio->save();

        return redirect('/envios/mostrar/'.$envio->id)
            ->with('success', 'Envío consignado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $envio = Envio::find($id);

        if (is_null($envio)) {
            return redirect('/envios/recibidos')
                ->with('error', 'El envío que busca no existe');
        }

        $status;

        if (is_null($envio->lote->fecha_partida)) {
            $status = 'Por despachar';
        } else if (is_null($envio->lote->fecha_arribo)) {
            $status = 'despachado';
        } else if (is_null($envio->fecha_retiro)) {
            $status = 'por entregar';
        } else {
            $status = 'entregado';
        }

        return view('envios.show', [
            'envio' => $envio,
            'status' => $status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $envio = Envio::find($id);

        if (is_null($envio)) {
            return redirect('/envios/recibidos')
                ->with('error', 'El envío que busca no existe');
        }

        if (!is_null($envio->fecha_consignacion)) {
            return redirect('/envios/mostrar/'.$envio->id)
                ->with('error', 'Este envío ya fue entregado anteriormente');
        }

        $envio->fecha_consignacion = DB::raw('CURRENT_TIMESTAMP');
        $envio->save();

        return redirect('/envios/mostrar/'.$envio->id)
            ->with('success', 'Envío actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio)
    {
        //
    }
}
