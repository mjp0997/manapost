@extends('layout.layout')

@section('content')
   <section class="Section">
      <form class="Section__Box" method="POST" action="{{ url('/transportes/actualizar/'.$transporte->id) }}">
         <h1 class="Modal__Title">Actualizar Transporte</h1>

         @csrf

         @method('PUT')

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Marca:</label>
   
            <input name="marca" class="Modal__Input" type="text" value="{{ old('marca', $transporte->marca) }}" required>
   
            <label class="Modal__Label">Modelo:</label>
   
            <input name="modelo" class="Modal__Input" type="text" value="{{ old('modelo', $transporte->modelo) }}" required>
   
            <label class="Modal__Label">Placa:</label>
   
            <input name="placa" class="Modal__Input" type="text" value="{{ old('placa', $transporte->placa) }}" required>
         </div>
   
         <div class="Modal__Info">
            <label class="Modal__Label">Chofer:</label>

            <select name="rol" class="Modal__Input" required>
               <option disabled value="">Seleccione un chofer...</option>

               @foreach ($choferes as $chofer)
                  <option value="{{ $chofer->id }}" {{ old('chofer', $transporte->chofer->id) == $chofer->id ? 'selected' : '' }}>
                     {{ $chofer->nombre }} - {{ $chofer->sucursal->nombre }} - {{ $chofer->sucursal->ciudad->nombre }}
                  </option>
               @endforeach
            </select>
         </div>

         <div class="Modal__ButtonBox">
            <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

            <button class="Modal__Button Save" type="submit">Actualizar</button>
         </div>
      </form>
   </section>
@endsection