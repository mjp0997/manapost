@extends('layout.lotes-layout')

@section('content')
<div class="section-content">
   <h1 class="Section__Title">{{ $title }}</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif
   
   <div class="Table">
      <div class="Table__Row envios">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            @if (in_array('ruta', $columnas))
               <div class="Table__Text">Ruta</div>
            @endif

            @if (in_array('transporte', $columnas))
               <div class="Table__Text">Transporte</div>
            @endif

            @if (in_array('fecha_arribo', $columnas))
               <div class="Table__Text">Fecha arribo</div>
            @endif

            @if (in_array('fecha_partida', $columnas))
               <div class="Table__Text">Fecha partida</div>
            @endif
         </div>
      </div>

      @if (count($lotes) < 1)
         <div style="text-align: center; font-size: 1.6rem; color: red;">
            No hay registros para mostrar...
         </div>
      @else
         @foreach ($lotes as $lote)
            <div class="Table__Row envios">
               <div class="Table__Info">
                  <div class="Table__ID">{{ $lote->id }}</div>
                  
                  @if (in_array('ruta', $columnas))
                     <div class="Table__Text">
                        {{ $lote->ruta->origen->nombre }} - {{ $lote->ruta->origen->ciudad->nombre }} - {{ $lote->ruta->origen->ciudad->estado->nombre }} / {{ $lote->ruta->destino->nombre }} - {{ $lote->ruta->destino->ciudad->nombre }} - {{ $lote->ruta->destino->ciudad->estado->nombre }}
                     </div>
                  @endif

                  @if (in_array('transporte', $columnas))
                     <div class="Table__Text">
                        {{ $lote->transporte->chofer->nombre }} / {{ $lote->transporte->modelo }} - {{ $lote->transporte->marca }}
                     </div>
                  @endif

                  @if (in_array('fecha_arribo', $columnas))
                     <div class="Table__Text">
                        {{ date_format(date_create($lote->fecha_arribo), 'd / m / Y') }}
                     </div>
                  @endif

                  @if (in_array('fecha_partida', $columnas))
                     <div class="Table__Text">
                        {{ date_format(date_create($lote->fecha_partida), 'd / m / Y') }}
                     </div>
                  @endif
               </div>

               <div class="Table__ButtonBox">
                  <a class="Table__Button See" href="{{ url('/lotes/mostrar/'.$lote->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach
      @endif
   </div>
</div>
@endsection