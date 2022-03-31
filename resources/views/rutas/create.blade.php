@extends('layout.locaciones-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/rutas/guardar') }}">
   <h1 class="Modal__Title">Agregar Ruta</h1>

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Origen:</label>

      <select name="origen" class="Modal__Input" required>
         @if (is_null(old('origen')))
            <option disabled selected value="">Seleccione una sucursal...</option>
            @foreach ($sucursales as $sucursal)
               <option value="{{ $sucursal->id }}">
                  {{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }}
               </option>
            @endforeach
         @else
            <option disabled value="">Seleccione un sucursal...</option>
            @foreach ($sucursales as $sucursal)
               <option value="{{ $sucursal->id }}" {{ old('origen') == $sucursal->id ? 'selected' : '' }}>
                  {{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }}
               </option>
            @endforeach
         @endif
      </select>

      <label class="Modal__Label">Destino:</label>

      <select name="destino" class="Modal__Input" required>
         @if (is_null(old('destino')))
            <option disabled selected value="">Seleccione una sucursal...</option>
            @foreach ($sucursales as $sucursal)
               <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }}</option>
            @endforeach
         @else
            <option disabled value="">Seleccione un sucursal...</option>
            @foreach ($sucursales as $sucursal)
               <option value="{{ $sucursal->id }}" {{ old('destino') == $sucursal->id ? 'selected' : '' }}>{{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }}</option>
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