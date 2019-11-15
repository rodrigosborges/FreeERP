@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <style>
        .well{
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f3f6f7;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        }
        
        .exibeEvento{
            background-color: #fff;
            min-height: 100px;
            max-width: 338px;
            margin: 10px 10px 10px 10px;
            border-radius: 10px;
        }
        
        .containerImg{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 260px;
        }
        
        .info{
            padding: 5px 5px 5px 5px;
            border-top: 1px solid grey;
        }
        
        h2{
            font-size: 18px;
        }
        
        p{
            font-size: 14px;
        }
        
        img{
            max-height: 250px;
            max-width: 250px;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
            <h1 style="text-align: center;">Próximos eventos</h1>
        </div>
    </div>
    
    <!-- EVENTOS -->
    <div class="well">
        <div class="row justify-content-center">
            @foreach ($eventos as $evento)
                <div class="col exibeEvento">
                    <div class="containerImg">
                        <div class="img">
                            @if($evento->imagem != '')
                                <img src="http://127.0.0.1:8000/storage/eventos/{{$evento->imagem}}">
                            @else
                                <img src="http://ulbra-to.br/geda/wp-content/themes/geda/img/miniatura.jpg">
                            @endif
                        </div>
                    </div>
                    <div class="info">
                        <a class="text-dark" href="{{route('eventos.detalhar', $evento->id)}}"><h2>{{$evento->nome}}</h2></a>
                        <p>{{\Carbon\Carbon::parse($evento->dataInicio)->format('d/m/Y')}} - {{$evento->cidade->nomeCidade}}/{{$evento->cidade->estado->uf}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    
@endsection