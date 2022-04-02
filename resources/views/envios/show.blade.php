@extends('layout.envios-layout')

@section('content')
<div class="section-content">
   <h1 class="Modal__Title">Envío</h1>

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   @if (session('success'))
      <p style="color: rgb(14, 206, 14)">{{session('success')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label peso">Peso:</label>

      <input name="peso" class="Modal__Input" type="number" value="{{ $envio->peso }}" readonly>

      <label class="Modal__Label monto">Monto:</label>

      <input name="monto" class="Modal__Input" type="number" value="{{ $envio->monto }}" readonly>

      <label class="Modal__Label">Estado:</label>

      <input
         name="monto"
         class="Modal__Input"
         type="text"
         value="{{ $status }}"
         readonly
         style="font-weight: 600; color: #FF2A00;"
      >
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Descripción:</label>

      <input name="descripcion" class="Modal__Input" type="text" value="{{ $envio->descripcion }}" readonly>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Ruta:</label>

      <input name="descripcion" class="Modal__Input" type="text" value="{{ $envio->lote->ruta->origen->nombre }} - {{ $envio->lote->ruta->origen->ciudad->nombre }} - {{ $envio->lote->ruta->origen->ciudad->estado->nombre }} / {{ $envio->lote->ruta->destino->nombre }} - {{ $envio->lote->ruta->destino->ciudad->nombre }} - {{ $envio->lote->ruta->destino->ciudad->estado->nombre }}" readonly>
   </div>

   <div class="envios-container">
      <div class="datos-personales">
         <h2 class="Modal__Title">Remitente</h2>

         <div class="Modal__Info">
            <label class="Modal__Label">Cedula:</label>
   
            <input
               name="cedula_remitente"
               class="Modal__Input"
               type="number"
               value="{{ $envio->remitente->cedula }}"
               readonly
            >
         </div>
         
         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>
      
            <input
               name="nombre_remitente"
               class="Modal__Input"
               type="text"
               value="{{ $envio->remitente->nombre }}"
               readonly
            >
         </div>

         <div class="Modal__Info">
            <label class="Modal__Label">Dirección:</label>
      
            <input
               name="direccion_remitente"
               class="Modal__Input"
               type="text"
               value="{{ $envio->remitente->direccion }}"
               readonly
            >
         </div>
      </div>

      <div class="datos-personales">
         <h2 class="Modal__Title">Destinatario</h2>

         <div class="Modal__Info">
            <label class="Modal__Label">Cedula:</label>
   
            <input name="cedula_destinatario" class="Modal__Input" type="number" value="{{ $envio->destinatario->cedula }}" readonly>
         </div>

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>
      
            <input name="nombre_destinatario" class="Modal__Input" type="text" value="{{ $envio->destinatario->nombre }}" readonly>
         </div>
      </div>
   </div>

   <div class="Modal__ButtonBox">
      @if (!is_null($envio->lote->fecha_partida) && !is_null($envio->lote->fecha_arribo))
         <form method="POST" action="{{ url('/envios/actualizar/'.$envio->id) }}">
            @csrf

            @method('PUT')

            <button type="submit" class="Modal__Button Add">Marcar como retirado</button>
         </form>
      @endif

      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>
   </div>
</div>
@endsection