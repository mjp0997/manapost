@extends('layout.locaciones-layout')

@section('content')
<div class="section-content">
   <h1 class="Section__Title">Sucursales</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="Section__Form">
      <a class="Section__Button Add" href="{{ url('sucursales/crear') }}">Agregar</a>
   </div>
   
   <div class="Table">
      <div class="Table__Row">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            <div class="Table__Text">Nombre</div>

            <div class="Table__Text">Ciudad</div>

            <div class="Table__Text">Estado</div>
         </div>
      </div>

      @if (count($sucursales) < 1)
         <div style="text-align: center; font-size: 1.6rem; color: red;">
            No hay registros para mostrar...
         </div>
      @else
         @foreach ($sucursales as $sucursal)
            <div class="Table__Row">
               <div class="Table__Info">
                  <div class="Table__ID">{{ $sucursal->id }}</div>

                  <div class="Table__Text">{{ $sucursal->nombre }}</div>

                  <div class="Table__Text">{{ $sucursal->ciudad->nombre }}</div>

                  <div class="Table__Text">{{ $sucursal->ciudad->estado->nombre }}</div>
               </div>

               <div class="Table__ButtonBox">
                  <a class="Table__Button Edit" href="{{ url('/sucursales/editar/'.$sucursal->id) }}"><span class="icon-pencil"></span>Editar</a>

                  <form method="POST" action="{{ url('/sucursales/eliminar/'.$sucursal->id) }}">
                     @csrf

                     @method('DELETE')

                     <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                  </form>

                  <a class="Table__Button See" href="{{ url('/sucursales/mostrar/'.$sucursal->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach

         {{ $sucursales->links() }}
      @endif
   </div>
</div>
@endsection