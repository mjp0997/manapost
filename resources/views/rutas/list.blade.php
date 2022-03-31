@extends('layout.locaciones-layout')

@section('content')
<div class="section-content">
   <h1 class="Section__Title">Rutas</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="Section__Form">
      <a class="Section__Button Add" href="{{ url('rutas/crear') }}">Agregar</a>
   </div>
   
   <div class="Table">
      <div class="Table__Row">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            <div class="Table__Text">Origen</div>

            <div class="Table__Text">Destino</div>
         </div>
      </div>

      @if (count($rutas) < 1)
         <div style="text-align: center; font-size: 1.6rem; color: red;">
            No hay registros para mostrar...
         </div>
      @else
         @foreach ($rutas as $ruta)
            <div class="Table__Row">
               <div class="Table__Info">
                  <div class="Table__ID">{{ $ruta->id }}</div>

                  <div class="Table__Text">{{ $ruta->origen->nombre }} - {{ $ruta->origen->ciudad->nombre }}</div>

                  <div class="Table__Text">{{ $ruta->destino->nombre }} - {{ $ruta->destino->ciudad->nombre }}</div>
               </div>

               <div class="Table__ButtonBox">
                  <a class="Table__Button Edit" href="{{ url('/rutas/editar/'.$ruta->id) }}"><span class="icon-pencil"></span>Editar</a>

                  <form method="POST" action="{{ url('/rutas/eliminar/'.$ruta->id) }}">
                     @csrf

                     @method('DELETE')

                     <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                  </form>

                  <a class="Table__Button See" href="{{ url('/rutas/mostrar/'.$ruta->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach
      @endif
   </div>
</div>
@endsection