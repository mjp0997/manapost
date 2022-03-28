@extends('layout.layout')

@section('content')
   <section class="Section">
      <article class="Section__Box">
         <h1 class="Section__Title">Ciudades</h1>

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         @if (session('success'))
            <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
         @endif

         <div class="Section__Form">
            <a class="Section__Button Add" href="{{ url('ciudades/crear') }}">Agregar</a>
         </div>
         
         <div class="Table">
            <div class="Table__Row">
               <div class="Table__Title">
                  <div class="Table__ID">ID</div>

                  <div class="Table__Text">Nombre</div>

                  <div class="Table__Text">Estado</div>
               </div>
            </div>

            @if (count($ciudades) < 1)
               <div style="text-align: center; font-size: 1.6rem; color: red;">
                  No hay registros para mostrar...
               </div>
            @else
               @foreach ($ciudades as $ciudad)
                  <div class="Table__Row">
                     <div class="Table__Info">
                        <div class="Table__ID">{{ $ciudad->id }}</div>

                        <div class="Table__Text">{{ $ciudad->nombre }}</div>

                        <div class="Table__Text">{{ $ciudad->estado->nombre }}</div>
                     </div>

                     <div class="Table__ButtonBox">
                        <a class="Table__Button Edit" href="{{ url('/ciudades/editar/'.$ciudad->id) }}"><span class="icon-pencil"></span>Editar</a>

                        <form method="POST" action="{{ url('/ciudades/eliminar/'.$ciudad->id) }}">
                           @csrf

                           @method('DELETE')

                           <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                        </form>

                        <a class="Table__Button See" href="{{ url('/ciudades/mostrar/'.$ciudad->id) }}"><span class="icon-eye"></span>Ver</a>
                     </div>
                  </div>
               @endforeach
            @endif
         </div>
      </article>
   </section>
@endsection