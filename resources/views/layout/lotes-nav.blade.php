<div class="navigation">
   <a
      href="{{ url('/lotes/recibidos') }}"
      class="navigation-tab {{ request()->is('lotes/recibidos') ? 'active' : '' }}"
   >Recibidos</a>

   <a
      href="{{ url('/lotes/despachados') }}"
      class="navigation-tab {{ request()->is('lotes/despachados') ? 'active' : '' }}"
   >Despachados</a>
   
   <a
      href="{{ url('/lotes/consignados') }}"
      class="navigation-tab {{ request()->is('lotes/consignados') ? 'active' : '' }}"
   >Por despachar</a>
</div>