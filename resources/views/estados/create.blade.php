@extends('layout.layout')

@section('content')

<section class="Section">
   <form class="Section__Box" method="POST" action="{{ url('/estados/guardar') }}">
      <h1 class="Modal__Title">Agregar Estado</h1>

      @csrf

      @method('POST')

      @if (session('error'))
         <p style="color: red">{{session('error')}}</p>
      @endif

      <div class="Modal__Info">
         <label class="Modal__Label">Nombre:</label>

         <input name="nombre" class="Modal__Input" type="text" value="{{ old('nombre') }}" required>
      </div>

      <div class="Modal__ButtonBox">
         <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

         <button class="Modal__Button Save" type="submit">Crear</button>
      </div>
   </form>
</section>
@endsection