<ul class="nav nav-tabs flex-column flex-sm-row" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="cliente-tab" data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" aria-selected="true">Cliente</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="sobre-tab" data-toggle="tab" href="#sobre" role="tab" aria-controls="sobre" aria-selected="false">Sobre O.S.</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pecas-tab" data-toggle="tab" href="#pecas" role="tab" aria-controls="pecas" aria-selected="false">Peças</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="maoObra-tab" data-toggle="tab" href="#maoObra" role="tab" aria-controls="maoObra" aria-selected="false">Mão de Obra</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tecnico-tab" data-toggle="tab" href="#tecnico" role="tab" aria-controls="tecnico" aria-selected="true">Técnico</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
    @include('assistencia::paginas.consertos._cliente')
  </div>

  <div class="tab-pane fade" id="sobre" role="tabpanel" aria-labelledby="sobre-tab">
    @include('assistencia::paginas.consertos._sobre')
  </div>

  <div class="tab-pane fade" id="pecas" role="tabpanel" aria-labelledby="pecas-tab">
      @include('assistencia::paginas.consertos._pecas')
  </div>

  <div class="tab-pane fade" id="maoObra" role="tabpanel" aria-labelledby="maoObra-tab">
    @include('assistencia::paginas.consertos._maoObra')
  </div>

  <div class="tab-pane fade show" id="tecnico" role="tabpanel" aria-labelledby="tecnico-tab">
    @include('assistencia::paginas.consertos._tecnico')
  </div>
</div>
