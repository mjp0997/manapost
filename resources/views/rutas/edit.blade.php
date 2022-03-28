@extends('layout.layout')

@section('content')
   <section class="Section">
      <form class="Section__Box" method="POST" action="{{ url('/rutas/actualizar/'.$ruta->id) }}">
         <h1 class="Modal__Title">Actualizar Ruta</h1>

         @csrf

         @method('PUT')

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Origen:</label>

            <select name="origen" class="Modal__Input" required>
               <option disabled value="">Seleccione una sucursal...</option>

               @foreach ($sucursales as $sucursal)
                  <option value="{{ $sucursal->id }}" {{ old('origen', $ruta->origen->id) == $sucursal->id ? 'selected' : '' }}>
                     {{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }}
                  </option>
               @endforeach
            </select>

            <label class="Modal__Label">Destino:</label>
   
            <select name="destino" class="Modal__Input" required>
               <option disabled value="">Seleccione una sucursal...</option>

               @foreach ($sucursales as $sucursal)
                  <option value="{{ $sucursal->id }}" {{ old('destino', $ruta->destino->id) == $sucursal->id ? 'selected' : '' }}>
                     {{ $sucursal->nombre }} - {{ $sucursal->ciudad->nombre }}
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