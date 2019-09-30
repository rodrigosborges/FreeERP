<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    
</head>
<body>
        <div class="row"><h3>Ordem de serviço nº {{$conserto->numeroOrdem}}</h3></div>
        <hr>
        <div class="text-center">
            <h4>Cliente</h4>
        </div>
        <div class="row">
            <div class="col-6">
                Nome: {{$conserto->cliente->nome}}
            </div>
            <div class="offset-6 col-6">
                CPF: {{$conserto->cliente->cpf}}
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {{$conserto->cliente->celnumero}}
            </div>
            <div class="offset-6 col-6">
                {{$conserto->cliente->telefonenumero}}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                Aparelho: {{$conserto->modelo_aparelho}}
            </div>
            <div class="offset-6 col-6">
                Marca: {{$conserto->marca_aparelho}}
            </div>
        </div>
       
     
        <div class="text-center">
            <h4>Checklist</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <strong>Estado do aparelho:</strong> (  ) Riscado (  ) Quebrado (  ) Arranhado (  ) Trincado (  ) Amassado <br>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            <br>
                Display danificado? (  )
            </div>
            <div class="offset-6 col-6">
            <br>
                Aparelho liga? (  ) ________
            </div>
        </div>
        <hr>
        <div class="row">
            <div>
                Funcionamento - Os componentes do dispositivo estão funcionando corretamente? S ou N (  ) <br>
                (  ) Touch | (  ) Lanterna/Flash | (  ) Leitor de cartão de memória | (  ) Leitor do SIM <br>
                (  ) Antena de rede | (  ) Antena Wifi/Bluetooth | (  ) Sensor de proximidade | (  ) Microfone <br>
                (  ) Auto-falante | (  ) Auricular | (  ) Conector de carga | (  ) Conector P2 | (  ) Botões <br>
                (  ) Camera Traseira | (  ) Camera frontal 
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                Reclamação:
            </div>
            <div class="offset-6 col-6">
                Observações:
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {{$conserto->defeito}}
            </div>
            <div class="offset-6 col-6">
                {{$conserto->obs}}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                Funcionario:<br><br>
                ________________________________
            </div>
            <div class="offset-6 col-6">
                Cliente: <br><br>
                ________________________________
            </div>
        </div>

</body>
</html>