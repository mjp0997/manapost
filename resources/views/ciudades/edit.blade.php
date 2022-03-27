@extends('layout.layout')

@section('content')
   <section class="Section">
      <form class="Section__Box" method="POST" action="{{ url('/ciudades/actualizar/'.$ciudad->id) }}">
         <h1 class="Modal__Title">Actualizar Ciudad</h1>

         @csrf

         @method('PUT')

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>

            <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre', $ciudad->nombre) }}" required>

            <label class="Modal__Label">Estado:</label>
   
            <select name="estado" class="Modal__Input" required>
               <option disabled value="">Seleccione un estado...</option>

               @foreach ($estados as $estado)
                  <option value="{{ $estado->id }}" {{ old('estado', $ciudad->estado->id) == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
               @endforeach
            </select>
         </div>

         <div class="Modal__ButtonBox">
            <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

            <button class="Modal__Button Save" type="submit">Actualizar</button>
         </div>
      </form>
   </section>
@endsection