@extends('layout.envios-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/envios/guardar') }}">
   <h1 class="Modal__Title">Consignar envío</h1>

   <input type="hidden" name="consignatario" value="{{ Auth::user()->empleado->id }}">

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label peso">Peso:</label>

      <input name="peso" class="Modal__Input " type="number" value="{{ old('peso') }}" required>

      <label class="Modal__Label monto">Monto:</label>

      <input name="monto" class="Modal__Input " type="number" value="{{ old('monto') }}" required>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Descripción:</label>

      <input name="descripcion" class="Modal__Input" type="text" value="{{ old('descripcion') }}" required>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Ruta:</label>

      <select name="ruta" class="Modal__Input" required>
         @if (is_null(old('ruta')))
            <option disabled selected value="">Seleccione una ruta...</option>
            @foreach ($rutas as $ruta)
               <option
                  value="{{ $ruta->id }}"
               >
                  {{ $ruta->origen->nombre.' - '.$ruta->origen->ciudad->nombre.' - '.$ruta->origen->ciudad->estado->nombre }}
                  {{' / '}}
                  {{ $ruta->destino->nombre.' - '.$ruta->destino->ciudad->nombre.' - '.$ruta->destino->ciudad->estado->nombre }}
               </option>
            @endforeach
         @else
            <option disabled value="">Seleccione una ruta...</option>
            @foreach ($rutas as $ruta)
               <option
                  value="{{ $ruta->id }}" {{ old('ruta') == $ruta->id ? 'selected' : '' }}
                  >
                     {{ $ruta->origen->nombre.' - '.$ruta->origen->ciudad->nombre.' - '.$ruta->origen->ciudad->estado->nombre }}
                     {{' / '}}
                     {{ $ruta->destino->nombre.' - '.$ruta->destino->ciudad->nombre.' - '.$ruta->destino->ciudad->estado->nombre }}
               </option>
            @endforeach
         @endif
      </select>
   </div>

   <div class="envios-container">
      <div class="datos-personales">
         <h2 class="Modal__Title">Remitente</h2>

         @if (session('error_cliente'))
            <p style="color: red">{{session('error_cliente')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Cedula:</label>
   
            <input
               name="cedula_remitente"
               class="Modal__Input"
               type="number"
               value="{{ old('cedula_remitente') }}"
               {{ is_null(session('cliente')) ? 'required' : 'readonly' }}
            >
         </div>

         @if (is_null(session('cliente')) && !is_null(session('error_cliente')))
            <div class="Modal__Info">
               <label class="Modal__Label">Nombre:</label>
         
               <input
                  name="nombre_remitente"
                  class="Modal__Input"
                  type="text"
                  value="{{ old('nombre_remitente') }}"
                  required
               >
            </div>

            <div class="Modal__Info">
               <label class="Modal__Label">Dirección:</label>
         
               <input
                  name="direccion_remitente"
                  class="Modal__Input"
                  type="text"
                  value="{{ old('direccion_remitente') }}"
                  required
               >
            </div>
         @endif

         @if (!is_null(session('cliente')))
            <div class="Modal__Info">
               <label class="Modal__Label">Nombre:</label>
         
               <input
                  name="nombre_remitente"
                  class="Modal__Input"
                  type="text"
                  value="{{ session('cliente')->nombre }}"
                  readonly
               >
            </div>

            <div class="Modal__Info">
               <label class="Modal__Label">Dirección:</label>
         
               <input
                  name="direccion_remitente"
                  class="Modal__Input"
                  type="text"
                  value="{{ session('cliente')->direccion }}"
                  readonly
               >
            </div>
         @endif
      </div>

      <div class="datos-personales">
         <h2 class="Modal__Title">Destinatario</h2>

         <div class="Modal__Info">
            <label class="Modal__Label">Cedula:</label>
   
            <input name="cedula_destinatario" class="Modal__Input" type="number" value="{{ old('cedula_destinatario') }}" required>
         </div>

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>
      
            <input name="nombre_destinatario" class="Modal__Input" type="text" value="{{ old('nombre_destinatario') }}" required>
         </div>
      </div>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Crear</button>
   </div>
</form>
@endsection