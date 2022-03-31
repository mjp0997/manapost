@extends('layout.personal-layout')

@section('content')
<div class="section-content">
   <h1 class="Modal__Title">Transporte</h1>

   <div class="Modal__Info">
      <label class="Modal__Label">Marca:</label>

      <input name="marca" class="Modal__Input" type="text" value="{{ $transporte->marca }}" readonly>

      <label class="Modal__Label">Modelo:</label>

      <input name="modelo" class="Modal__Input" type="text" value="{{ $transporte->modelo }}" readonly>

      <label class="Modal__Label">Placa:</label>

      <input name="placa" class="Modal__Input" type="text" value="{{ $transporte->placa }}" readonly>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Chofer:</label>

      <input name="edad" class="Modal__Input" type="text" value="{{ $transporte->chofer->nombre }}" readonly>
      
      <label class="Modal__Label">Sucursal de empleo:</label>

      <input name="sucursal" class="Modal__Input" type="text" value="{{ $transporte->chofer->sucursal->nombre }} - {{ $transporte->chofer->sucursal->ciudad->nombre }} - {{ $transporte->chofer->sucursal->ciudad->estado->nombre }}" readonly>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
   </div>
</div>
@endsection