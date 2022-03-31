@extends('layout.locaciones-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/ciudades/guardar') }}">
   <h1 class="Modal__Title">Agregar Ciudad</h1>

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Nombre:</label>

      <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre') }}" required>

      <label class="Modal__Label">Estado:</label>

      <select name="estado" class="Modal__Input" required>
         @if (is_null(old('estado')))
            <option disabled selected value="">Seleccione un estado...</option>
            @foreach ($estados as $estado)
               <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
            @endforeach
         @else
            <option disabled value="">Seleccione un estado...</option>
            @foreach ($estados as $estado)
               <option value="{{ $estado->id }}" {{ old('estado') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
            @endforeach
         @endif
      </select>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Crear</button>
   </div>
</form>
@endsection