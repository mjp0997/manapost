<div class="navigation">
   <a
      href="{{ url('/envios/crear') }}"
      class="navigation-tab {{ request()->is('envios/crear') ? 'active' : '' }}"
   >Consignar envío</a>

   <a
      href="{{ url('/envios/recibidos') }}"
      class="navigation-tab {{ request()->is('envios/recibidos') ? 'active' : '' }}"
   >Por entregar</a>

   <a
      href="{{ url('/envios/consignados') }}"
      class="navigation-tab {{ request()->is('envios/consignados') ? 'active' : '' }}"
   >Por despachar</a>

   <a
      href="{{ url('/envios/despachados') }}"
      class="navigation-tab {{ request()->is('envios/despachados') ? 'active' : '' }}"
   >Despachados</a>

   <a
      href="{{ url('/envios/entregados') }}"
      class="navigation-tab {{ request()->is('envios/entregados') ? 'active' : '' }}"
   >Entregados</a>
</div>