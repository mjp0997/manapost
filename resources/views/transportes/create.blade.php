@extends('layout.personal-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/transportes/guardar') }}">
   <h1 class="Modal__Title">Agregar Transporte</h1>

   @csrf

   @method('POST')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Marca:</label>

      <input name="marca" class="Modal__Input" type="text" value="{{ old('marca') }}" required>

      <label class="Modal__Label">Modelo:</label>

      <input name="modelo" class="Modal__Input" type="text" value="{{ old('modelo') }}" required>

      <label class="Modal__Label">Placa:</label>

      <input name="placa" class="Modal__Input" type="text" value="{{ old('placa') }}" required>
   </div>

   <div class="Modal__Info">
      <label class="Modal__Label">Chofer:</label>

      <select name="chofer" class="Modal__Input" required>
         @if (is_null(old('chofer')))
            <option disabled selected value="">Seleccione un chofer...</option>
            @foreach ($choferes as $chofer)
               <option value="{{ $chofer->id }}">
                  {{ $chofer->nombre }} - {{ $chofer->sucursal->nombre }} - {{ $chofer->sucursal->ciudad->nombre }}
               </option>
            @endforeach
         @else
            <option disabled value="">Seleccione un chofer...</option>
            @foreach ($choferes as $chofer)
               <option value="{{ $chofer->id }}" {{ old('chofer') == $chofer->id ? 'selected' : '' }}>
                  {{ $chofer->nombre }} - {{ $chofer->sucursal->nombre }} - {{ $chofer->sucursal->ciudad->nombre }}
               </option>
            @endforeach
         @endif
      </select>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Crear</button>
   </div>
</form>
@endsection