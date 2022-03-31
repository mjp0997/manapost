@include('layout.header')

@include('layout.sidebar')

<section class="Section">
   <article class="Section__Box section-navigable">
      @include('layout.personal-nav')

      @yield('content')
   </article>
</section>

@include('layout.footer')