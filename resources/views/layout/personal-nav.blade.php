<div class="navigation">
   <a
      href="{{ url('/empleados') }}"
      class="navigation-tab {{ request()->is('empleados*') ? 'active' : '' }}"
   >Empleados</a>

   <a
      href="{{ url('/usuarios') }}"
      class="navigation-tab {{ request()->is('usuarios*') ? 'active' : '' }}"
   >Usuarios</a>

   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV']))
      <a
         href="{{ url('/roles') }}"
         class="navigation-tab {{ request()->is('roles*') ? 'active' : '' }}"
      >Roles</a>
   @endif

   <a
      href="{{ url('/transportes') }}"
      class="navigation-tab {{ request()->is('transportes*') ? 'active' : '' }}"
   >Transportes</a>
</div>