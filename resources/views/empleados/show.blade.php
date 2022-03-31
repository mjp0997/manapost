@extends('layout.personal-layout')

@section('content')
<div class="section-content">
   <h1 class="Modal__Title">Empleado</h1>

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">ID:</label>

      <input name="id" class="Modal__Input" style="flex-grow: 0; width: 7.5%; min-width: 74px;" type="text" value="{{ $empleado->id }}" readonly>

      <label class="Modal__Label">Nombre:</label>

      <input name="nombre" class="Modal__Input" type="text" value="{{ $empleado->nombre }}" readonly>

      <label class="Modal__Label">Cedula:</label>

      <input name="cedula" class="Modal__Input" type="text" value="{{ $empleado->cedula }}" readonly>
   </div>
   
   <div class="Modal__Info">
      <label class="Modal__Label">Edad:</label>

      <input name="edad" class="Modal__Input" type="text" value="{{ $empleado->edad }}" readonly>
      
      <label class="Modal__Label">Fecha de nacimiento:</label>

      <input name="fecha_nacimiento" class="Modal__Input" type="text" value="{{ date_format(date_create($empleado->fecha_nacimiento), 'd / m / Y') }}" readonly>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Rol:</label>

      <input name="rol" class="Modal__Input" style="flex-grow: 0; width: 15%; min-width: 145px;" type="text" value="{{ $empleado->rol->nombre }}" readonly>

      @if ($empleado->sucursal)
         <label class="Modal__Label">Sucursal:</label>

         <input name="sucursal" class="Modal__Input" type="text" value="{{ $empleado->sucursal->nombre }} - {{ $empleado->sucursal->ciudad->nombre }} - {{ $empleado->sucursal->ciudad->estado->nombre }}" readonly>
      @endif
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Dirección:</label>

      <input name="nombre" class="Modal__Input" type="text" value="{{ $empleado->direccion }}" readonly>
   </div>

   <hr class="separator" />

   @if (!is_null($empleado->usuario))
      <div class="Modal__Info">
         <label class="Modal__Label">Usuario:</label>

         <input name="nombre" class="Modal__Input" type="text" value="{{ $empleado->usuario->usuario }}" readonly>
      </div>
   @endif

   <div class="Modal__ButtonBox">
      @if (is_null($empleado->usuario))
         <a class="Modal__Button Add" href="{{ url('/usuarios/crear/'.$empleado->id) }}">Generar usuario</a>
      @else
         <a class="Modal__Button Add" href="{{ url('/usuarios/editar/'.$empleado->usuario->id) }}">Nueva contraseña</a>

         <form method="POST" action="{{ url('/usuarios/eliminar/'.$empleado->usuario->id) }}">
            @csrf
            
            @method('DELETE')
            
            <button type="submit" class="Modal__Button Return">Eliminar usuario</button>
         </form>
      @endif

      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
   </div>
</div>
@endsection