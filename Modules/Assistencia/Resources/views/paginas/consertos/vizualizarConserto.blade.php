@extends('assistencia::layouts.master')
@section('css')
	<style type="text/css">
		.header{
			display:flex;
			justify-content: space-between;
			align-items: center; 
		}
		.header img {
			width: 60%;
		}
		.pequeno {
			font-size: 12px;
		}
    

    

    
	</style>
@stop
@section('content')

  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-11">
            <h4>Vizualização da ordem de serviço</h4>
          </div>
          <div class="col-1"><input type="button" id="print" value="Print"><i class="material-icons">local_printshop</i></div>
        </div>
        
      </div>
<div id="imprimir">
      <div class="card-body">
        <div class="header">
          <div class="">
            <img class="img-fluid" src="{{ URL::to('/') }}/img/logo.png">
          </div>
          <div class="">
            <h4>Ordem de serviço nº {{$conserto->numeroOrdem}}</h4>
            
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-6 col-md-12 row text-center">
            <div class="col-12">
              <h5>Cliente</h5>
              <hr>
            </div>

            <div class="col-6">
              {{$conserto->cliente->nome}}
            </div>
            <div class="col-6">
              {{$conserto->cliente->celnumero}}
            </div><div class="col-6">
              {{$conserto->cliente->cpf}}
            </div>
            <div class="col-6">
              {{$conserto->cliente->telefonenumero}}
            </div>

          </div>
          <div class="col-lg-6 col-md-12 row  text-center">
            <div class="col-12">
              <h5>Aparelho</h5>
              <hr>
            </div>

            <div class="col-6">
              Modelo: {{$conserto->modelo_aparelho}}
            </div>
            <div class="col-6">
              Serial: {{$conserto->serial_aparelho}}
            </div><div class="col-6">
              Marca: {{$conserto->marca_aparelho}}
            </div>
            <div class="col-6">
              IMEI: {{$conserto->imei_aparelho}}
            </div>

          </div>
        </div>
        
        <hr>
        <div class="row text-center">
          <div class="col-12 ">
            <h4>Valor a ser pago</h4>
            <hr>
          </div>
          <div class="col-4">
            <?php 
              $val_peças = 0;
              $val_servicos = 0;
            ?>
            @foreach ($pecaOS as $peca)
            <?php 
              $val_peças += $peca->peca->valor_venda;
            ?>
            @endforeach
            @foreach ($itemServico as $servico)
            <?php 
              $val_servicos += $servico->servico->valor;
            ?>	
            @endforeach
            Peças: R${{$val_peças}}
          </div>
          <div class="col-4">
            Mão de obra: R${{$val_servicos}}
          </div>
          <div class="col-4">
            Valor total: R${{$conserto->valor}}
          </div>
        </div>
      </div>
      <hr>
        <div class="row text-center ">
          <div class="col-12">
            <h4>Defeito/Reclamação</h4>
            <hr>
          </div>
          <div class="col-6">
            <h5>Defeito:<br></h5>
            {{$conserto->defeito}}
          </div>
          <div class="col-6">
            <h5>Observações:<br></h5>

            {{$conserto->obs}}
          </div>

        </div>
        <hr>
        <div class="row">
          <div class="col-12 text-center">
            <h4>Serviços</h4>
            <hr>
          </div>
          <div class="col-lg-6 col-md-12 row text-center">
            <div class="col-12">
              <h5>Peças</h5>

            </div>
            @foreach ($pecaOS as $peca)
            <div class="col-12 text-center">
              {{$peca->peca->nome}} | R${{$peca->peca->valor_venda}}
            </div>

            @endforeach
          </div>
          <div class="col-lg-6 col-md-12 row">
            <div class="col-12 text-center">
              <h5>Mão de obra</h5>

            </div>
            @foreach ($itemServico as $servico)
              <div class="col-12 text-center">
                {{$servico->servico->nome}} | R${{$servico->servico->valor}}
              </div>

            @endforeach
          </div>
        </div>

        <hr>
        <div class="pequeno">
          Data da ultima alteração: {{$conserto->data_entrada}}
        </div>
    </div>
  </div>
</div>


@stop
@section('js')
    <script>
      
        $('#print').click(function(){
          var conteudo = document.getElementById('imprimir').innerHTML;
          var telaImpressao = window.open('about:blank');

          telaImpressao.document.write('<html><head><title>' + document.title  + '</title>');
          telaImpressao.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">');
          telaImpressao.document.write('<style type="text/css">.header{display:flex;justify-content: space-between;align-items: center; }.header img {width: 60%;}.pequeno {font-size: 12px;}</style>')
          telaImpressao.document.write('</head><body >');
          telaImpressao.document.write('<div class="container">')
          telaImpressao.document.write('<div class="card">')
          telaImpressao.document.write(conteudo)
          telaImpressao.document.write('</div>')
          telaImpressao.document.write('</body></html>');

          telaImpressao.document.close(); 
          telaImpressao.focus(); 



          telaImpressao.window.print();
          telaImpressao.window.close();
          
        })
      
      

    </script>
@stop