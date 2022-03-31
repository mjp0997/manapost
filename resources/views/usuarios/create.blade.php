@extends('layout.personal-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/usuarios/guardar') }}">

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <h1 class="Modal__Title">Agregar Usuario</h1>

   <div class="Modal__Info">
      <label class="Modal__Label">Usuario:</label>

      <input name="usuario" class="Modal__Input" type="text" value="{{ old('usuario') }}" required>

      <label class="Modal__Label">Contraseña:</label>

      <input name="clave" class="Modal__Input" type="text" value="{{ old('clave') }}" required>

      <input type="hidden" name="empleado" value="{{ $empleado->id }}">
   </div>

   <hr class="separator" />

   <div class="Modal__Info disabled">
      <label class="Modal__Label">ID:</label>

      <input class="Modal__Input" style="flex-grow: 0; width: 7.5%; min-width: 74px;" type="text" value="{{ $empleado->id }}" readonly>

      <label class="Modal__Label">Nombre:</label>

      <input class="Modal__Input" type="text" value="{{ $empleado->nombre }}" readonly>

      <label class="Modal__Label">Cedula:</label>

      <input class="Modal__Input" type="text" value="{{ $empleado->cedula }}" readonly>
   </div>
   
   <div class="Modal__Info disabled">
      <label class="Modal__Label">Edad:</label>

      <input class="Modal__Input" type="text" value="{{ $empleado->edad }}" readonly>
      
      <label class="Modal__Label">Fecha de nacimiento:</label>

      <input class="Modal__Input" type="text" value="{{ date_format(date_create($empleado->fecha_nacimiento), 'd / m / Y') }}" readonly>
   </div>

   <div class="Modal__Info disabled">
      <label class="Modal__Label">Rol:</label>

      <input class="Modal__Input" style="flex-grow: 0; width: 15%; min-width: 145px;" type="text" value="{{ $empleado->rol->nombre }}" readonly>
      
      <label class="Modal__Label">Sucursal:</label>

      <input class="Modal__Input" type="text" value="{{ $empleado->sucursal->nombre }} - {{ $empleado->sucursal->ciudad->nombre }} - {{ $empleado->sucursal->ciudad->estado->nombre }}" readonly>
   </div>

   <div class="Modal__Info disabled">
      <label class="Modal__Label">Dirección:</label>

      <input class="Modal__Input" type="text" value="{{ $empleado->direccion }}" readonly>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Crear</button>
   </div>
</form>
@endsection