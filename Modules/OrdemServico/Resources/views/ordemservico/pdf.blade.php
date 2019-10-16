<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="card " style="margin:auto; max-width: 40rem;">
        <div class="card-header bg-dark text-white">ID :{{ $data['model']->id }} </div>
        <div class="card-body">
            <p class="card-text text-info">Solicitante </p>
            <p class="card-text text-secondary"> Nome: {{ $data['model']->solicitante->nome}}</p>
            <p class="card-text text-secondary"> Identificacao: {{ $data['model']->solicitante->id}}</p>
            <p class="card-text text-secondary"> Telefone: {{ $data['model']->solicitante->telefones}}</p>
            <hr>

            <p class="card-text text-info">Aparelho</p>
            <p class="card-text text-secondary"> Marca: {{ $data['model']->aparelho->marca}}</p>
            <p class="card-text text-secondary"> Tipo Aparelho: {{ $data['model']->aparelho->tipo_aparelho}}</p>
            <hr>

            <p class="card-text text-info">Problema</p>
            <p class="card-text text-secondary"> Titulo: {{ $data['model']->problema->titulo}}</p>
            <p class="card-text text-secondary"> Prioridade: {{ $data['model']->problema->prioridade}}</p>


            <hr>
            <p class="card-text text-info">Descricao:</p>
            <p class="card-text text-secondary">{{ $data['model']->descricao}}</p>

        </div>
    </div>
</body>

</html>