
<ul class="nav justify-content-center">
  <li class="nav-item">
  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ativos</a>
  </li>
  <li class="nav-item">
  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Inativos</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="table-responsive">
  <table id="tabela" class="table table-striped">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($tecnicos as $tecnico)
          <tr>
            <td scope="row">{{$tecnico->nome }}</td>
            <td>{{$tecnico->cpf }}</td>
            <td>
              <a href="{{route('tecnico.editar',$tecnico->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
              <a href="{{route('tecnico.deletar',$tecnico->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
              <td colspan="100%" class="text-center">
              <p class="text-center">
                
                  Página {{$tecnicos->currentPage()}} de {{$tecnicos->lastPage()}}
                  
              </p>
              </td>
          </tr>
          @if($tecnicos->lastPage() > 1)
          <tr>
              <td colspan="100%">
                  {{ $tecnicos->links() }}
              </td>
          </tr>
          @endif
      </tfoot>
    </div>
  </table>
</div>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <div class="table-responsive">
  <table id="tabela" class="table table-striped">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($tecnicosDeletados as $tecnico)
          <tr>
            <td scope="row">{{$tecnico->nome }}</td>
            <td>{{$tecnico->cpf }}</td>
            <td>
              <a href="{{route('tecnico.editar',$tecnico->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
              <a href="{{route('tecnico.deletar',$tecnico->id)}}"><button type="button" class="btn btn-warning">Ativar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
              <td colspan="100%" class="text-center">
              <p class="text-center">
                
                  Página {{$tecnicosDeletados->currentPage()}} de {{$tecnicosDeletados->lastPage()}}
                  
              </p>
              </td>
          </tr>
          @if($tecnicosDeletados->lastPage() > 1)
          <tr>
              <td colspan="100%">
                  {{ $tecnicosDeletados->links() }}
              </td>
          </tr>
          @endif
      </tfoot>
    </div>
  </table>
</div>
  </div>

</div>


