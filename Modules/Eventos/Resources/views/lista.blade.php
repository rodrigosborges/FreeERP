<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Lista de presença</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
        <style>
            table{
                width: 100%;
            }
            
            table, th, td{
                border: 1px solid black;
                border-collapse: collapse;
            }
            
            button{
                float: right;
            }
        </style>
    </head>
    <body>
        <button class="imprimir"><i class="material-icons">print</i></button>
        <h1>{{$programacao->evento->nome}}</h1>
        <h2>{{$programacao->nome}} - {{\Carbon\Carbon::parse($programacao->data)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($programacao->horario)->format('H:i')}}</h2>
        <table id="pessoas" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center" style="min-width: 180px;">Assinatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programacao->participantes as $pessoa)
                    <tr>
                        <td class="text-center align-middle">{{$pessoa->nome}}</td>
                        <td class="text-center align-middle">{{$pessoa->email}}</td>
                        <td class="text-center align-middle"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>
            $('.imprimir').click(function(){
                $('.imprimir').hide();
                window.print();
                location.reload();
            });
        </script>
    </body>
</html>
