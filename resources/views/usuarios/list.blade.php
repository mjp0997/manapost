@extends('layout.personal-layout')

@section('content')
<div class="section-content">
   <h1 class="Section__Title">Usuarios</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif
   
   <div class="Table">
      <div class="Table__Row" style="grid-template-columns: 2fr 1fr;">
         <div class="Table__Title">
            <div class="Table__ID">ID</div>

            <div class="Table__Text">Empleado</div>

            <div class="Table__Text">Usuario</div>
         </div>
      </div>

      @if (count($usuarios) < 1)
         <div style="text-align: center; font-size: 1.6rem; color: red;">
            No hay registros para mostrar...
         </div>
      @else
         @foreach ($usuarios as $usuario)
            <div class="Table__Row" style="grid-template-columns: 2fr 1fr;">
               <div class="Table__Info">
                  <div class="Table__ID">{{ $usuario->id }}</div>

                  <div class="Table__Text">{{ $usuario->empleado->nombre }}</div>

                  <div class="Table__Text">{{ $usuario->usuario }}</div>
               </div>

               <div class="Table__ButtonBox">
                  <form method="POST" action="{{ url('/usuarios/eliminar/'.$usuario->id) }}">
                     @csrf

                     @method('DELETE')

                     <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                  </form>

                  <a class="Table__Button See" href="{{ url('/empleados/mostrar/'.$usuario->empleado->id) }}"><span class="icon-eye"></span>Ver</a>
               </div>
            </div>
         @endforeach
      @endif
   </div>
</div>
@endsection