@extends('layout.locaciones-layout')

@section('content')
<div class="section-content">
   <h1 class="Modal__Title">Ruta</h1>

   <div class="Modal__Info">
      <label class="Modal__Label">Origen:</label>

      <input name="origen" class="Modal__Input" type="text" value="{{ $ruta->origen->nombre }} - {{ $ruta->origen->ciudad->nombre }} - {{ $ruta->origen->ciudad->estado->nombre }}" readonly>

      <label class="Modal__Label">Destino:</label>

      <input name="destino" class="Modal__Input" type="text" value="{{ $ruta->destino->nombre }} - {{ $ruta->destino->ciudad->nombre }} - {{ $ruta->destino->ciudad->estado->nombre }}" readonly>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
   </div>
</div>
@endsection