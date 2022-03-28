@extends('layout.layout')

@section('content')
   <section class="Section">
      <form class="Section__Box" method="POST" action="{{ url('/roles/actualizar/'.$rol->id) }}">
         <h1 class="Modal__Title">Actualizar Rol</h1>

         @csrf

         @method('PUT')

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>

            <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre', $rol->nombre) }}" required>
         </div>

         <div class="Modal__ButtonBox">
            <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

            <button class="Modal__Button Save" type="submit">Actualizar</button>
         </div>
      </form>
   </section>
@endsection