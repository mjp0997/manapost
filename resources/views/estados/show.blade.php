@extends('layout.locaciones-layout')

@section('content')
<div class="section-content">
   <h1 class="Modal__Title">Estado</h1>

   <div class="Modal__Info">
      <label class="Modal__Label">Nombre:</label>

      <input name="nombre" class="Modal__Input" type="text" value="{{ $estado->nombre }}" readonly>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
   </div>
</div>
@endsection