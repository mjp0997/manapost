@extends('layout.layout')

@section('content')
<section class="Section">
   
<article class="Section__Box" id="Envios" style="opacity: 1;">
      <h1 class="Section__Title"><span class="icon-briefcase"></span>Envios</h1>
      <form class="Section__Form">
         <input class="Section__Button Add" type="submit" value="Agregar">
         <input class="Section__Textfield" type="text" placeholder="ID">
         <input class="Section__Button" type="submit" value="Buscar">
      </form>
      <div class="Table">
         <div class="Table__Row">
            <div class="Table__Title">
               <div class="Table__ID">ID</div>
               <div class="Table__Text">Fecha</div>
               <div class="Table__Text">Monto</div>
            </div>
            <div></div>
         </div>
         <div class="Table__Row">
            <div class="Table__Info">
               <div class="Table__ID">01</div>
               <div class="Table__Text">10/05/2022</div>
               <div class="Table__Text">105.4$</div>
            </div>
            <div class="Table__ButtonBox">
               <button class="Table__Button Edit"><span class="icon-pencil"></span>Editar</button>
               <button class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
               <button class="Table__Button See"><span class="icon-eye"></span>Ver</button>
            </div>
         </div>
      </div>
   </article><article class="Section__BoxSub" id="Lotes" style="opacity: 1;">
      <h1 class="Section__Title"><span class="icon-briefcase"></span>Lotes</h1>
      <form class="Section__Form">
         <input class="Section__Button Add" type="submit" value="Agregar">
         <input class="Section__Textfield" type="text" placeholder="ID">
         <input class="Section__Button" type="submit" value="Buscar">
      </form>
      <div class="Table">
         <div class="Table__Row">
            <div class="Table__Title">
               <div class="Table__ID">ID</div>
               <div class="Table__Text">Fecha Partida</div>
               <div class="Table__Text">Fecha Arribo</div>
            </div>
            <div></div>
         </div>
         <div class="Table__Row">
            <div class="Table__Info">
               <div class="Table__ID">01</div>
               <div class="Table__Text">10/05/2022</div>
               <div class="Table__Text">10/08/2022</div>
            </div>
            <div class="Table__ButtonBox">
               <button class="Table__Button Edit"><span class="icon-pencil"></span>Editar</button>
               <button class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
               <button class="Table__Button See"><span class="icon-eye"></span>Ver</button>
            </div>
         </div>
         <div class="Table__Row">
            <div class="Table__Info">
               <div class="Table__ID">01</div>
               <div class="Table__Text">10/05/2022</div>
               <div class="Table__Text">10/08/2022</div>
            </div>
            <div class="Table__ButtonBox">
               <button class="Table__Button Edit"><span class="icon-pencil"></span>Editar</button>
               <button class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
               <button class="Table__Button See"><span class="icon-eye"></span>Ver</button>
            </div>
         </div>
         <div class="Table__Row">
            <div class="Table__Info">
               <div class="Table__ID">01</div>
               <div class="Table__Text">10/05/2022</div>
               <div class="Table__Text">10/08/2022</div>
            </div>
            <div class="Table__ButtonBox">
               <button class="Table__Button Edit"><span class="icon-pencil"></span>Editar</button>
               <button class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
               <button class="Table__Button See"><span class="icon-eye"></span>Ver</button>
            </div>
         </div>
         <div class="Table__Row">
            <div class="Table__Info">
               <div class="Table__ID">01</div>
               <div class="Table__Text">10/05/2022</div>
               <div class="Table__Text">10/08/2022</div>
            </div>
            <div class="Table__ButtonBox">
               <button class="Table__Button Edit"><span class="icon-pencil"></span>Editar</button>
               <button class="Table__Button Delete"><span class="icon-bin"></span>Borrar</button>
               <button class="Table__Button See"><span class="icon-eye"></span>Ver</button>
            </div>
         </div>
      </div>
   </article>
</section>
@endsection