<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['title']}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .inline{
            display:  inline-block;
            width: 24%;
        }

        .bordered{
            border: 1px solid black;
        }

        .bordered2{
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            page-break-after: never;
        }

        @page { 
            margin-top: 262px;
            margin-left: 50px;
            margin-right: 50px;
            margin-bottom: 97px; 
        }

        header { position: fixed; top: -220px; left: 0px; right: 0px; }
        footer { position: fixed; bottom: -15px; left: 0px; right: 0px; }
    </style>
</head>
<body>

    <header>
        <h1 class="text-center"><b>Folha de ponto</b></h1>
        <h5 class="mt-3"><b>Funcionário:</b> {{$data['funcionario']->nome}}</h5>
        <h5 class="mt-3"><b>Mês de referência:</b> {{ ucfirst(strftime('%B de %Y', strtotime($data['pontos'][0]->created_at))) }}</h5>
        <h5 class="mt-3"><b>Tempo trabalhado:</b> {{ $data['total'] }}</h5>

        <div class="mt-4 pt-1 bordered">
            <div class="inline text-center">
                <b>Dia</b>
            </div>
            <div class="inline text-center">
                <b>Entrada</b>
            </div>
            <div class="inline text-center">
                <b>Saída</b>
            </div>
            <div class="inline text-center">
                <b>Tempo trabalhado</b>
            </div>
        </div>
    </header>

    <footer class="text-center">
        <div>___________________________________</div>
        <div>{{$data['funcionario']->nome}}</div>
        <div>{{date('d/m/Y')}}</div>
    </footer>

    <div class="bordered2">
        @for($i=0; $i < count($data['pontos']); $i+=2)
            <div class="mt-2">
                <div class="inline text-center">
                    <span>{{ $data['pontos'][$i]->get_day() }}</span>
                </div>
                <div class="inline text-center">
                    <span>{{ $data['pontos'][$i]->get_time() }}</span>
                </div>
                <div class="inline text-center">
                    <span>{{ $data['pontos'][$i+1]->get_time() }}</span>
                </div>
                <div class="inline text-center">
                    <span>{{ $data['pontos'][$i]->timeTo($data['pontos'][$i+1]) }}</span>
                </div>
            </div>
            <hr class="mt-0 mb-0">
        @endfor
    </div>

</body>
</html>
    