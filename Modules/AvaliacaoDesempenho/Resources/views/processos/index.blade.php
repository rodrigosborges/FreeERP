@extends('template')

@section('css')
<link href="{{Module::asset('avaliacaodesempenho:css/processos/index.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">

        <div class="card">

            <div class="card-header">
                <div class="row">
                    <h3>Processos</h3>
                    <span>
                        <a href="/tcc/public/avaliacaodesempenho/processos/create" class="btn btn-primary">Adicionar</a>
                    </span>
                </div>
            </div>

            <div class="card-body">
                <h1>Aqui a tabela com a listagem de Processos (Ativos/Correntes e Inativos/Finalizados)</h1>
            </div>

            <div class="card-footer"></div>

        </div>

    </div>

@endsection

@section('scripts')
@endsection