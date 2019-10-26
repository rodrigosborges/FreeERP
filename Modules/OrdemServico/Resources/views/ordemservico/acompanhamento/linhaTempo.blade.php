@extends('ordemservico::layouts.informacoes')
@section('css')
<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>
@endsection
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="card " style="margin:auto; width: 50rem;">
            <div class="card-header bg-info text-white">Acompanhar OS</div>
            <div class="card-body h-100">
                <h4>Ultimas Atualizações</h4>
                <ul class="timeline">
          
                    @foreach($data['model']->historico as $historico)
                    <li>
                        <a href="#">{{ $historico->titulo}}</a>
                        <a href="#" class="float-right">{{ $historico->pivot->updated_at->format('d/m/Y H:i:s')}}</a>
                       
                    </li>
                    @endforeach
                    <li>
                        <a href="#">Iniciada</a>
                        <a href="#" class="float-right">{{$data['model']->created_at->format('d/m/Y H:i:s')}}</a>
                       
                </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection