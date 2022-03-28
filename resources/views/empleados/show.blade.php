@extends('layout.layout')

@section('content')
   <section class="Section">
      <div class="Section__Box">
         <h1 class="Modal__Title">Empleado</h1>

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
            
            <label class="Modal__Label">Sucursal:</label>

            <input name="sucursal" class="Modal__Input" type="text" value="{{ $empleado->sucursal->nombre }} - {{ $empleado->sucursal->ciudad->nombre }} - {{ $empleado->sucursal->ciudad->estado->nombre }}" readonly>
         </div>

         <div class="Modal__Info">
            <label class="Modal__Label">Dirección:</label>

            <input name="nombre" class="Modal__Input" type="text" value="{{ $empleado->direccion }}" readonly>
         </div>

         <div class="Modal__ButtonBox">
            <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
         </div>
      </div>
   </section>
@endsection