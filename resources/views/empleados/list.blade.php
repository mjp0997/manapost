@extends('layout.personal-layout')

@section('content')
<div class="section-content">
   <h1 class="Section__Title">Empleados</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="Section__Form">
      <a class="Section__Button Add" href="{{ url('empleados/crear') }}">Agregar</a>
   </div>
   
   <div class="Table">
      <div class="Table__Row">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            <div class="Table__Text">Nombre</div>

            <div class="Table__Text">Rol</div>
         </div>
      </div>

      @if (count($empleados) < 1)
         <div style="text-align: center; font-size: 1.6rem; color: red;">
            No hay registros para mostrar...
         </div>
      @else
         @foreach ($empleados as $empleado)
            <div class="Table__Row">
               <div class="Table__Info">
                  <div class="Table__ID">{{ $empleado->id }}</div>

                  <div class="Table__Text">{{ $empleado->nombre }}</div>

                  <div class="Table__Text">{{ $empleado->rol->nombre }}</div>
               </div>

               <div class="Table__ButtonBox">
                  <a class="Table__Button Edit" href="{{ url('/empleados/editar/'.$empleado->id) }}"><span class="icon-pencil"></span>Editar</a>

                  <form method="POST" action="{{ url('/empleados/eliminar/'.$empleado->id) }}">
                     @csrf

                     @method('DELETE')

                     <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                  </form>

                  <a class="Table__Button See" href="{{ url('/empleados/mostrar/'.$empleado->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach
      @endif
   </div>
</div>
@endsection
