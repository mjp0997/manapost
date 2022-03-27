@extends('layout.layout')

@section('content')
   <section class="Section">
      <div class="Section__Box">
         <h1 class="Modal__Title">Sucursal</h1>

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>

            <input name="nombre" class="Modal__Input" type="text" value="{{ $sucursal->nombre }}" readonly>

            <label class="Modal__Label">Ciudad:</label>

            <input name="estado" class="Modal__Input" type="text" value="{{ $sucursal->ciudad->nombre }} - {{ $sucursal->ciudad->estado->nombre }}" readonly>
         </div>

         <div class="Modal__ButtonBox">
            <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
         </div>
      </div>
   </section>
@endsection