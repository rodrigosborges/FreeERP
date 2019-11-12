<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Certificado</title>
 
        <style>
            /*font-family: 'Pinyon Script', cursive;*/
            *{
                margin: 0;
            }
            
            #frente{
                /*background-image: url("https://i.pinimg.com/originals/14/92/61/1492615cc43dd3cf1ac6d9147dffda5c.jpg");*/
                background-image: url("/storage/certificado/certificado.jpg");
                background-repeat: no-repeat;
                background-position: center center;
                height: 100%;
            }
            
            h1{
                text-align: center;
                font-size: 50px;
                padding-top: 150px;
            }
            
            p{
                font-size: 20px;
            }
            
            #texto{
                margin-top: 50px;
                padding: 20px 180px;
            }
            
            #data{
                text-align: right;
                padding: 20px 180px;
            }
            
            #assinatura{
                margin-top: 80px;
            }
            
            #verso{
                padding: 80px 30px;
            }
            
        </style>
    </head>
    <body>
        <div id="frente" style="page-break-after: always;">
            <h1>CERTIFICADO</h1>
            <p id="texto" align="justify">Certificamos que <b>{{ $pessoa->nome }}</b> participou do evento <b>{{ $evento->nome }}</b> com carga horária de {{\Carbon\Carbon::parse($cargaHoraria)->format('H:i')}}h.</p>
            <p id="data">{{ $evento->cidade->nomeCidade }}, {{ $data }}.</p>
            <p id="assinatura" align="center">_______________________</p>
            <p align="center">{{ $evento->empresa }}</p>
        </div>
        
        <div id="verso">
            <p align="center">Atividades:</p>
            <ul>
                @foreach($participou as $atividade)
                    <li>{{$atividade->nome}} ({{\Carbon\Carbon::parse($atividade->duracao)->format('H:i')}}h)</li>
                @endforeach
            </ul>
        </div>
    </body>
</html>