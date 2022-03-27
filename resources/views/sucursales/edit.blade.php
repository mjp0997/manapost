@extends('layout.layout')

@section('content')
   <section class="Section">
      <form class="Section__Box" method="POST" action="{{ url('/sucursales/actualizar/'.$sucursal->id) }}">
         <h1 class="Modal__Title">Actualizar Sucursal</h1>

         @csrf

         @method('PUT')

         @if (session('error'))
            <p style="color: red">{{session('error')}}</p>
         @endif

         <div class="Modal__Info">
            <label class="Modal__Label">Nombre:</label>

            <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre', $sucursal->nombre) }}" required>

            <label class="Modal__Label">Ciudad:</label>
   
            <select name="ciudad" class="Modal__Input" required>
               <option disabled value="">Seleccione una ciudad...</option>

               @foreach ($ciudades as $ciudad)
                  <option value="{{ $ciudad->id }}" {{ old('ciudad', $sucursal->ciudad->id) == $ciudad->id ? 'selected' : '' }}>
                     {{ $ciudad->nombre }} - {{ $ciudad->estado->nombre }}
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