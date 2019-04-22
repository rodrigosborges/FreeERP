@extends('assistencia::layouts.master')


@section('css')
  <style media="screen">
  .module-assistencia {
    border-radius: 5px;
    background-color: rgba(123,155,166,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    }
    .buscador {
      background-color: rgba(65,91,118,0.5);
      border-radius: 5px;
      width: 90%;
      height: auto;
      overflow: auto;
    }
    .botaobusca {
      margin: 10px;
    }
    .campobusca{
      width: 100%;
      height: 100%
    }
    .campobusca .linha {
      width: 100%;
      display:flex;
      flex: row;
    }
    .campobusca .coluna-nome {
      width: 45%;
      margin-left: 5px;
    }
    .campobusca .coluna {
      width: 30%;
      margin-left: 5px;
    }
    .titulo-coluna {
      font-size: 20px;
      font-weight: bold;
    }

  </style>
@stop

@section('content')

  <div class="module-assistencia">

    <div class="buscador">
      <div class="botaobusca">
        <div class="card-body row no-gutters align-items-center">
          <div class="col-auto">
            <i class="fas fa-search h4 text-body"></i>
          </div>
          <div class="col">
            <input class="form-control" type="search" placeholder="Localizar cliente">
          </div>
          <div class="col-auto">
            <button class="btn btn-primary" type="submit">Buscar</button>
          </div>
        </div>
      </div>

      <div class="campobusca">
        <div class="linha">

          <div class="coluna-nome titulo-coluna">
            Nome
          </div>
          <div class="coluna titulo-coluna">
            CPF
          </div>
          <div class="coluna titulo-coluna">
            Telefone
          </div>

        </div>
        <!-- Aqui ficará o foreach captando os dados do bd com o link de edição-->
        <a href="#">
          <div class="linha">
            <div class="coluna-nome">
              Rafael Alves de Jesus
            </div>
            <div class="coluna">
              454.659.508/54
            </div>
            <div class="coluna">
              (12) 98143-4149
            </div>
          </div>
        </a>




      </div>
    </div>

  </div>

@stop
