@extends('layout.locaciones-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/sucursales/guardar') }}">
   <h1 class="Modal__Title">Agregar Sucursal</h1>

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Nombre:</label>

      <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre') }}" required>

      <label class="Modal__Label">Ciudad:</label>

      <select name="ciudad" class="Modal__Input" required>
         @if (is_null(old('ciudad')))
            <option disabled selected value="">Seleccione una ciudad...</option>
            @foreach ($ciudades as $ciudad)
               <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }} - {{ $ciudad->estado->nombre }}</option>
            @endforeach
         @else
            <option disabled value="">Seleccione un ciudad...</option>
            @foreach ($ciudades as $ciudad)
               <option value="{{ $ciudad->id }}" {{ old('ciudad') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }} - {{ $ciudad->estado->nombre }}</option>
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