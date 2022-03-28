@extends('layout.layout')

@section('content')
   <section class="Section">
      <article class="Section__Box">
         <h1 class="Section__Title">Roles</h1>

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         @if (session('success'))
            <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
         @endif

         <div class="Section__Form">
            <a class="Section__Button Add" href="{{ url('roles/crear') }}">Agregar</a>
         </div>
         
         <div class="Table">
            <div class="Table__Row">
               <div class="Table__Title">
                  <div class="Table__ID">ID</div>

                  <div class="Table__Text">Nombre</div>
               </div>
            </div>

            @if (count($roles) < 1)
               <div style="text-align: center; font-size: 1.6rem; color: red;">
                  No hay registros para mostrar...
               </div>
            @else
               @foreach ($roles as $rol)
                  <div class="Table__Row">
                     <div class="Table__Info">
                        <div class="Table__ID">{{ $rol->id }}</div>

                        <div class="Table__Text">{{ $rol->nombre }}</div>
                     </div>

                     <div class="Table__ButtonBox">
                        <a class="Table__Button Edit" href="{{ url('/roles/editar/'.$rol->id) }}"><span class="icon-pencil"></span>Editar</a>

                        <form method="POST" action="{{ url('/roles/eliminar/'.$rol->id) }}">
                           @csrf

                           @method('DELETE')

                           <button type="submit" class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
                        </form>

                        <a class="Table__Button See" href="{{ url('/roles/mostrar/'.$rol->id) }}"><span class="icon-eye"></span>Ver</a>
                     </div>
                  </div>
               @endforeach
            @endif
         </div>
      </article>
   </section>
@endsection