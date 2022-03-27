@extends('layout.layout')

@section('content')
   <section class="Section">
      <article class="Section__Box">
         <h1 class="Section__Title">Estados</h1>

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         @if (session('success'))
            <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
         @endif

         <div class="Section__Form">
            <a class="Section__Button Add" href="{{ url('estados/crear') }}">Agregar</a>
         </div>
         
         <div class="Table">
            <div class="Table__Row">
               <div class="Table__Title">
                  <div class="Table__ID">ID</div>

                  <div class="Table__Text">Nombre</div>
               </div>
            </div>

            @if (count($estados) < 1)
               <div style="text-align: center; font-size: 1.6rem; color: red;">
                  No hay registros para mostrar...
               </div>
            @else
               @foreach ($estados as $estado)
                  <div class="Table__Row">
                     <div class="Table__Info">
                        <div class="Table__ID">{{ $estado->id }}</div>

                        <div class="Table__Text">{{ $estado->nombre }}</div>
                     </div>

                     <div class="Table__ButtonBox">
                        <a class="Table__Button Edit" href="{{ url('/estados/editar/'.$estado->id) }}"><span class="icon-pencil"></span>Editar</a>

                        <form method="POST" action="{{ url('/estados/eliminar/'.$estado->id) }}">
                           @csrf

                           @method('DELETE')

                           <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                        </form>

                        <a class="Table__Button See" href="{{ url('/estados/mostrar/'.$estado->id) }}"><span class="icon-eye"></span>Ver</a>
                     </div>
                  </div>
               @endforeach
            @endif
         </div>
      </article>
   </section>
@endsection