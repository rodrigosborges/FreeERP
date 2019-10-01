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
    <div class="text-center" style="width:60%;">
    
    
        <div class="row">
            <div class="col-6">
                <h6>Recibo nº {{$pagamento->id}}</h6>
            </div>
            
        </div>


        <div class="row">
            <div class="col-6">
                <p>Recebemos do cliente {{$pagamento->conserto->cliente->nome}}, CPF:
                    {{$pagamento->conserto->cliente->cpf}} a importancia liquida de R${{str_replace('.', ',',$pagamento->conserto->valor)}}
                    referente a ordem de serviço nº{{$pagamento->conserto->numeroOrdem}} na data de {{date("d/m/y")}}.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                ________________________________<br>
                Funcionario
            </div>
        </div>
    </div>
</body>
</html>