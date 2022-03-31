@extends('layout.personal-layout')

@section('content')
<form class="section-content" method="POST" action="{{ url('/usuarios/actualizar/'.$usuario->id) }}">
   <h1 class="Modal__Title">Actualizar Usuario</h1>

   @csrf

   @method('PUT')

   @if (session('error'))
      <p style="color: red">{{session('error')}}</p>
   @endif

   <div class="Modal__Info">
      <label class="Modal__Label">Usuario:</label>

      <input name="usuario" class="Modal__Input" type="text" value="{{ old('usuario', $usuario->usuario) }}" required>

      <label class="Modal__Label">Clave:</label>

      <input name="clave" class="Modal__Input" type="text" value="{{ old('clave') }}" placeholder="Ingrese la nueva clave" required>
   </div>

   <div class="Modal__ButtonBox">
      <a class="Modal__Button Return" href="{{ url()->previous() }}">Volver</a>

      <button class="Modal__Button Save" type="submit">Actualizar</button>
   </div>
</form>
@endsection