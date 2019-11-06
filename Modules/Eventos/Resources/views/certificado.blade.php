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
            
            body{
                /*background-image: url("https://i.pinimg.com/originals/14/92/61/1492615cc43dd3cf1ac6d9147dffda5c.jpg");*/
                background-image: url("/storage/certificado/certificado.jpg");
                background-repeat: no-repeat;
                background-position: center center;
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
            
        </style>
    </head>
    <body>
        <h1>CERTIFICADO</h1>
        <p id="texto" align="justify">Certificamos que <b>{{ $pessoa->nome }}</b> participou do evento <b>{{ $evento->nome }}</b> com carga horária de {{ $participou }}h.</p>
        <ul>
            
        </ul>
        <p id="data">{{ $evento->cidade->nomeCidade }}, {{ $data }}.</p>
        <p id="assinatura" align="center">_______________________</p>
        <p align="center">{{ $evento->empresa }}</p>
    </body>
</html>