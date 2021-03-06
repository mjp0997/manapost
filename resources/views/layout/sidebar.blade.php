<aside class="Aside">

   <div class="auth-user">
      <p>Bienvenido:</p>
      <p>{{ Auth::user()->empleado->nombre }}</p>
   </div>

   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN', 'GERENTE', 'ATENCION']))
      <a
         href="{{ url('/envios/recibidos') }}"
         class="Aside__Button {{ request()->is('envios*') ? 'active' : '' }}"
      >
         <span class="icon-briefcase"></span>
         Envíos
      </a>
   @endif

   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN', 'GERENTE', 'CHOFER']))
      <a
         href="{{ Auth::user()->empleado->rol->nombre == 'CHOFER' ? url('/lotes/consignados') : url('/lotes/recibidos') }}"
         class="Aside__Button {{ request()->is('lotes*') ? 'active' : '' }}"
      >
         <span class="icon-truck"></span>
         Lotes
      </a>
   @endif
   
   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN']))
      <a
         href="{{ url('/sucursales') }}"
         class="Aside__Button {{ request()->is('estados*', 'ciudades*', 'sucursales*', 'rutas*') ? 'active' : '' }}"
      >
         <span class="icon-office"></span>
         Locaciones
      </a>
   @endif
   
   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN', 'GERENTE']))
      <a
         href="{{ url('/empleados') }}"
         class="Aside__Button {{ request()->is('empleados*', 'roles*', 'usuarios*', 'transportes*') ? 'active' : '' }}"
      >
         <span class="icon-user"></span>
         Personal
      </a>
   @endif
   
   <div class="Aside__Img">
      <div class="Aside__Separator"></div>
   </div>
</aside>