@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <style>
        ul{
            list-style-type: none;
        }
        li{
            font-size: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="center">
        <h1>Certificados</h1>
    </div>
    @if(count($pessoa->certificado) < 1)
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="center">
            <p>Sem certificados para exibir!</p>
        </div>
    @else
        
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
            <ul>
                @foreach($pessoa->certificado as $certificado)
                <li style="margin-top: 30px;">{{$certificado->evento->nome}} <a href="/{{$certificado->certificado}}" target="_blank" class="btn btn-primary">Certificado</a></li>
                @endforeach
            </ul>
        </div>
            
    @endif
    
@endsection
