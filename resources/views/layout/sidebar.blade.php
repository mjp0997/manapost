<aside class="Aside">
   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN']))
      <a href="{{ url('/estados') }}" class="Aside__Button"><span class="icon-office"></span>Estados</a>
      
      <a href="{{ url('/ciudades') }}" class="Aside__Button"><span class="icon-office"></span>Ciudades</a>

      <a href="{{ url('/sucursales') }}" class="Aside__Button"><span class="icon-office"></span>Sucursales</a>

      <a href="{{ url('/rutas') }}" class="Aside__Button"><span class="icon-truck"></span>Rutas</a>
   @endif
   
   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV']))
      <a href="{{ url('/roles') }}" class="Aside__Button"><span class="icon-user"></span>Roles</a>
   @endif

   @if (in_array(Auth::user()->empleado->rol->nombre, ['DEV', 'ADMIN', 'GERENTE']))
      <a href="{{ url('/empleados') }}" class="Aside__Button"><span class="icon-user"></span>Empleados</a>

      <a href="{{ url('/usuarios') }}" class="Aside__Button"><span class="icon-user"></span>Usuarios</a>

      <a href="{{ url('/transportes') }}" class="Aside__Button"><span class="icon-truck"></span>Transportes</a>
   @endif

   
   <div class="Aside__Img">
      <div class="Aside__Separator"></div>
   </div>
</aside>