<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Prezado: {{ $avaliador->funcionario->nome }}</h3>

    <b>Você possui uma avaliação pendente.</b>

    <p>Sua senha de acesso é: <h4><b>{{ $avaliador->token }}</b></h4></p>
    <p>Com validade até: {{ date('d/m/Y', strtotime($avaliador->validade)) }}</p>

    <br>

    <p>
        <a href="http://localhost/tcc/public/avaliacaodesempenho/avaliacao/responder">Visite o link</a> 
        ,insira seu email e senha para ter acesso ao questionário.
    </p>

    <p>Está senha poderá ser usada uma única vez.</p>

    <p>Caso ultrapasse o prazo de validade da senha, procure um administrador do sistema.</p>
</body>
</html>