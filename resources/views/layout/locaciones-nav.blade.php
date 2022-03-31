<div class="navigation">
   <a
      href="{{ url('/estados') }}"
      class="navigation-tab {{ request()->is('estados*') ? 'active' : '' }}"
   >Estados</a>

   <a
      href="{{ url('/ciudades') }}"
      class="navigation-tab {{ request()->is('ciudades*') ? 'active' : '' }}"
   >Ciudades</a>

   <a
      href="{{ url('/sucursales') }}"
      class="navigation-tab {{ request()->is('sucursales*') ? 'active' : '' }}"
   >Sucursales</a>

   <a
      href="{{ url('/rutas') }}"
      class="navigation-tab {{ request()->is('rutas*') ? 'active' : '' }}"
   >Rutas</a>
</div>