@extends('layout.envios-layout')

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

            @if (in_array('fecha_consignacion', $columnas))
               <div class="Table__Text">Fecha consignación</div>
            @endif

            @if (in_array('fecha_retiro', $columnas))
               <div class="Table__Text">Fecha retiro</div>
            @endif

            @if (in_array('fecha_arribo', $columnas))
               <div class="Table__Text">Fecha arribo</div>
            @endif

            @if (in_array('cedula_remitente', $columnas))
               <div class="Table__Text">Cédula remitente</div>
            @endif

            @if (in_array('origen', $columnas))
               <div class="Table__Text">Origen</div>
            @endif

            @if (in_array('destino', $columnas))
               <div class="Table__Text">Destino</div>
            @endif
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
                  
                  @if (in_array('fecha_consignacion', $columnas))
                     <div class="Table__Text">{{ date_format(date_create($envio->fecha_consignacion), 'd / m / Y') }}</div>
                  @endif

                  @if (in_array('fecha_retiro', $columnas))
                     <div class="Table__Text">{{ date_format(date_create($envio->fecha_retiro), 'd / m / Y') }}</div>
                  @endif

                  @if (in_array('fecha_arribo', $columnas))
                     <div class="Table__Text">{{ date_format(date_create($envio->lote->fecha_arribo), 'd / m / Y') }}</div>
                  @endif

                  @if (in_array('origen', $columnas))
                     <div class="Table__Text">
                        {{ $envio->lote->ruta->origen->nombre }} - {{ $envio->lote->ruta->origen->ciudad->nombre }} - {{ $envio->lote->ruta->origen->ciudad->estado->nombre }}
                     </div>
                  @endif
      
                  @if (in_array('destino', $columnas))
                     <div class="Table__Text">
                        {{ $envio->lote->ruta->destino->nombre }} - {{ $envio->lote->ruta->destino->ciudad->nombre }} - {{ $envio->lote->ruta->destino->ciudad->estado->nombre }}
                     </div>
                  @endif
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