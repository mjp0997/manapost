@extends('layout.personal-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/empleados/guardar') }}">
   <h1 class="Modal__Title">Agregar Empleado</h1>

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Nombre:</label>

      <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre') }}" required>

      <label class="Modal__Label">Cedula:</label>

      <input name="cedula" class="Modal__Input" type="number" value="{{ old('cedula') }}" required>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Fecha de nacimiento:</label>

      <input name="fecha_nacimiento" class="Modal__Input" min="{{ $minDate }}" max="{{ $maxDate }}" type="date" value="{{ old('fecha_nacimiento') }}" required>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Rol:</label>

      <select name="rol" class="Modal__Input" required>
         @if (is_null(old('rol')))
            <option disabled selected value="">Seleccione un rol...</option>
            @foreach ($roles as $rol)
               <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
            @endforeach
         @else
            <option disabled value="">Seleccione un rol...</option>
            @foreach ($roles as $rol)
               <option value="{{ $rol->id }}" {{ old('rol') == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
            @endforeach
         @endif
      </select>

      @if (!in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN']))
         <input type="hidden" name="sucursal" value="{{ Auth::user()->empleado->sucursal_id }}">
      @else
         <label class="Modal__Label">Sucursal:</label>

         <select name="sucursal" class="Modal__Input" required>
            @if (is_null(old('sucursal')))
               <option disabled selected value="">Seleccione una sucursal...</option>
               @foreach ($sucursales as $sucursal)
                  <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }} - {{ $sucursal->ciudad->estado->nombre }}</option>
               @endforeach
            @else
               <option disabled value="">Seleccione una sucursal...</option>
               @foreach ($sucursales as $sucursal)
                  <option value="{{ $sucursal->id }}" {{ old('sucursal') == $sucursal->id ? 'selected' : '' }}>{{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }} - {{ $sucursal->ciudad->estado->nombre }}</option>
               @endforeach
            @endif
         </select>
      @endif

   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Dirección:</label>

      <input name="direccion" class="Modal__Input" type="text" value="{{ old('direccion') }}" required>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Crear</button>
   </div>
</form>
@endsection