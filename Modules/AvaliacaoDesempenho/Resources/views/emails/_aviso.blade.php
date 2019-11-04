<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h3>Prezado(a) {{ $avaliador->funcionario->nome }}</h3>

    <p>Você possui uma avaliaçâo pendente</p>
    <p>Faltam {{ $dias }} dias para o prazo final da avaliação</p>

    <a href="http://localhost/tcc/public/avaliacaodesempenho/avaliacao/responder">
        <p>Visite o link para ter acesso ao questionário</p>
    </a>
    
</body>
</html>