@extends('layout.lotes-layout')

@section('content')
<div class="section-content">
   <h1 class="Modal__Title">Lote</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Ruta:</label>

      <input name="descripcion" class="Modal__Input" type="text" value="{{ $lote->ruta->origen->nombre }} - {{ $lote->ruta->origen->ciudad->nombre }} - {{ $lote->ruta->origen->ciudad->estado->nombre }} / {{ $lote->ruta->destino->nombre }} - {{ $lote->ruta->destino->ciudad->nombre }} - {{ $lote->ruta->destino->ciudad->estado->nombre }}" readonly>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Estado:</label>

      <input
         name="monto"
         class="Modal__Input"
         type="text"
         value="{{ $status }}"
         readonly
         style="font-weight: 600; color: #FF2A00;"
      >
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">N° envíos:</label>

      <input
         name="monto"
         class="Modal__Input"
         type="text"
         value="{{ count($envios) }}"
         readonly
      >

      <label class="Modal__Label">Transporte:</label>

      <input
         name="monto"
         class="Modal__Input"
         type="text"
         value="{{ !is_null($lote->transporte) ? $lote->transporte->chofer->nombre : 'no asignado' }}"
         readonly
      >
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Fecha partida:</label>

      <input
         name="peso" 
         class="Modal__Input" 
         type="text" 
         value="{{ !is_null($lote->fecha_partida) ? date_format(date_create($lote->fecha_partida), 'd / m / Y') : 'No asignada' }}" 
         readonly
      >

      <label class="Modal__Label">Fecha arribo:</label>

      <input
         name="monto"
         class="Modal__Input"
         type="text"
         value="{{ !is_null($lote->fecha_arribo) ? date_format(date_create($lote->fecha_arribo), 'd / m / Y') : 'No asignada' }}"
         readonly
      >
   </div>

   <div class="Modal__ButtonBox">
      @if (is_null($lote->fecha_partida) && is_null($lote->fecha_arribo) && is_null($lote->transporte))
         <a href="{{ url('/lotes/transporte/'.$lote->id) }}" class="Modal__Button Add">Asignar transporte</a>
      @endif

      @if (is_null($lote->fecha_partida) && is_null($lote->fecha_arribo) && !is_null($lote->transporte))
         <form method="POST" action="{{ url('/lotes/despachar/'.$lote->id) }}">
            @csrf

            @method('PUT')

            <button type="submit" class="Modal__Button Add">Marcar como despachado</button>
         </form>
      @endif

      @if (!is_null($lote->fecha_partida) && is_null($lote->fecha_arribo) && !is_null($lote->transporte))
         <form method="POST" action="{{ url('/lotes/recibir/'.$lote->id) }}">
            @csrf

            @method('PUT')

            <button type="submit" class="Modal__Button Add">Marcar como recibido</button>
         </form>
      @endif

      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
   </div>
</div>

<hr class="separator" style="margin: 0.5rem 0" />

<div class="section-content">
   <h1 class="Section__Title">Envios pertenecientes al lote</h1>

   <div class="Table">
      <div class="Table__Row envios">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            <div class="Table__Text">Peso</div>

            <div class="Table__Text">Monto</div>
         </div>
      </div>

      @if (count($envios) < 1)
         <div style="text-align: center; font-size: 1.6rem; color: red;">
            No hay registros para mostrar...
         </div>
      @else
         @foreach ($envios as $envio)
            <div class="Table__Row envios">
               <div class="Table__Info">
                  <div class="Table__ID">{{ $envio->id }}</div>
                  
                  <div class="Table__Text">{{ $envio->peso }} gramos</div>

                  <div class="Table__Text">{{ $envio->monto }} bolívares</div>
               </div>

               <div class="Table__ButtonBox">
                  <a class="Table__Button See" href="{{ url('/envios/mostrar/'.$envio->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach
      @endif
   </div>
</div>
@endsection