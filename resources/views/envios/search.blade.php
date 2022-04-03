@extends('layout.envios-layout')

@section('content')
<div class="section-content">
   <h1 class="Section__Title">Buscar envíos</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="search-container">
      <form method="POST" action="{{ url('/envios/buscar') }}">
         @csrf

         <label class="Modal__Label search">Cédula remitente:</label>

         <input type="hidden" name="clave" value="cedula_remitente">

         <input
            name="valor"
            class="Modal__Input"
            type="number"
            value="{{ !is_null($clave) ? $clave == 'cedula_remitente' ? $valor : '' : '' }}">

         <button class="Modal__Button Save search" type="submit">Buscar</button>
      </form>

      <form method="POST" action="{{ url('/envios/buscar') }}">
         @csrf
         
         <label class="Modal__Label search">Cédula destinatario:</label>

         <input type="hidden" name="clave" value="cedula_destinatario">

         <input
            name="valor"
            class="Modal__Input"
            type="number"
            value="{{ !is_null($clave) ? $clave == 'cedula_destinatario' ? $valor : '' : '' }}">

         <button class="Modal__Button Save search" type="submit">Buscar</button>
      </form>

      <form method="POST" action="{{ url('/envios/buscar') }}">
         @csrf
         
         <label class="Modal__Label search">Nº envío:</label>

         <input type="hidden" name="clave" value="id">

         <input
            name="valor"
            class="Modal__Input"
            type="number"
            value="{{ !is_null($clave) ? $clave == 'id' ? $valor : '' : '' }}">

         <button class="Modal__Button Save search" type="submit">Buscar</button>
      </form>
   </div>
   
   <div class="Table">
      <div class="Table__Row envios">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            <div class="Table__Text">Estatus</div>
            
            <div class="Table__Text">Fecha consignación</div>

            <div class="Table__Text">Origen</div>

            <div class="Table__Text">Destino</div>
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

                  <div class="Table__Text">
                     {{ 'status' }}
                  </div>
                  
                  <div class="Table__Text">{{ date_format(date_create($envio->fecha_consignacion), 'd / m / Y') }}</div>

                  <div class="Table__Text">
                     {{ $envio->lote->ruta->origen->nombre }} - {{ $envio->lote->ruta->origen->ciudad->nombre }} - {{ $envio->lote->ruta->origen->ciudad->estado->nombre }}
                  </div>
      
                  <div class="Table__Text">
                     {{ $envio->lote->ruta->destino->nombre }} - {{ $envio->lote->ruta->destino->ciudad->nombre }} - {{ $envio->lote->ruta->destino->ciudad->estado->nombre }}
                  </div>
               </div>

               <div class="Table__ButtonBox">
                  <a class="Table__Button See" href="{{ url('/envios/mostrar/'.$envio->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach

         {{ $envios->links() }}
      @endif
   </div>
</div>
@endsection