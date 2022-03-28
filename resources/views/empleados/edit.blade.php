@extends('layout.layout')

@section('content')
   <section class="Section">
      <form class="Section__Box" method="POST" action="{{ url('/empleados/actualizar/'.$empleado->id) }}">
         <h1 class="Modal__Title">Actualizar Empleado</h1>

         @csrf

         @method('PUT')

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>
   
            <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre', $empleado->nombre) }}" required>
   
            <label class="Modal__Label">Cedula:</label>
   
            <input name="cedula" class="Modal__Input" type="text" value="{{ old('cedula', $empleado->cedula) }}" required>
         </div>
   
         <div class="Modal__Info">
            <label class="Modal__Label">Fecha de nacimiento:</label>
   
            <input name="fecha_nacimiento" class="Modal__Input" min="{{ $minDate }}" max="{{ $maxDate }}" type="date" value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento) }}" required>
         </div>
   
         <div class="Modal__Info">
            <label class="Modal__Label">Rol:</label>

            <select name="rol" class="Modal__Input" required>
               <option disabled value="">Seleccione un rol...</option>

               @foreach ($roles as $rol)
                  <option value="{{ $rol->id }}" {{ old('rol', $empleado->rol->id) == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
               @endforeach
            </select>
   
            <label class="Modal__Label">Sucursal:</label>

            <select name="sucursal" class="Modal__Input" required>
               <option disabled value="">Seleccione una sucursal...</option>

               @foreach ($sucursales as $sucursal)
                  <option value="{{ $sucursal->id }}" {{ old('sucursal', $empleado->sucursal->id) == $sucursal->id ? 'selected' : '' }}>{{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }} - {{ $sucursal->ciudad->estado->nombre }}</option>
               @endforeach
            </select>
         </div>
   
         <div class="Modal__Info">
            <label class="Modal__Label">Dirección:</label>
   
            <input name="direccion" class="Modal__Input" type="text" value="{{ old('direccion', $empleado->direccion) }}" required>
         </div>

         <div class="Modal__ButtonBox">
            <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

            <button class="Modal__Button Save" type="submit">Actualizar</button>
         </div>
      </form>
   </section>
@endsection