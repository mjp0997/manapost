@extends('layout.lotes-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/lotes/asignar/'.$lote->id) }}">
   <h1 class="Modal__Title">Asignar Transporte</h1>

   @csrf

   @method('PUT')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Ruta:</label>

      <input name="descripcion" class="Modal__Input" type="text" value="{{ $lote->ruta->origen->nombre }} - {{ $lote->ruta->origen->ciudad->nombre }} - {{ $lote->ruta->origen->ciudad->estado->nombre }} / {{ $lote->ruta->destino->nombre }} - {{ $lote->ruta->destino->ciudad->nombre }} - {{ $lote->ruta->destino->ciudad->estado->nombre }}" readonly>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Transporte:</label>

      <select name="transporte" class="Modal__Input" required>
         @if (is_null(old('transporte')))
            <option disabled selected value="">Seleccione un transporte...</option>
            @foreach ($transportes as $transporte)
               <option value="{{ $transporte->id }}">
                  {{ $transporte->chofer->nombre }} - {{ $transporte->modelo }} - {{ $transporte->marca }}
               </option>
            @endforeach
         @else
            <option disabled value="">Seleccione un transporte...</option>
            @foreach ($transportes as $transporte)
               <option value="{{ $transporte->id }}" {{ old('transporte') == $transporte->id ? 'selected' : '' }}>
                  {{ $transporte->chofer->nombre }} - {{ $transporte->modelo }} - {{ $transporte->marca }}
               </option>
            @endforeach
         @endif
      </select>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Actualizar</button>
   </div>
</form>
@endsection