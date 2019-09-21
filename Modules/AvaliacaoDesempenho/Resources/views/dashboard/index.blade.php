@extends('template')

@section('css')
<link href="{{Module::asset('avaliacaodesempenho:css/dashboard/index.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class='container'>

    <div class='row dash-cards'>

        <div class='col-md-4'>

            <div class='card'>

                <div class='card-header bg-primary'>
                    <span class='text-white'>INFORMAÇÕES GERAIS</span>
                </div>

                <ul class='list-group list-group-flush'>
                    <li class='list-group-item'>
                        <span class='list-label'>Processos Cadastrados</span>
                        <span class='list-content'>10</span>
                    </li>
                    <li class='list-group-item'>
                            <span class='list-label'>Avaliações Cadastradas</span>
                            <span class='list-content'>23</span>
                    </li>
                    <li class='list-group-item'>
                            <span class='list-label'>Funcionários Cadastrados</span>
                            <span class='list-content'>145</span>
                    </li>
                </ul>

                <div class='card-footer'></div>
            </div>

        </div>

        <div class='col-md-4'>

            <div class='card'>
                <div class='card-header bg-primary'></div>
                <div class='card-body'></div>
                <div class='card-footer'></div>
            </div>

        </div>

        <div class='col-md-4'>

            <div class='card'>
                <div class='card-header bg-primary'></div>
                <div class='card-body'></div>
                <div class='card-footer'></div>
            </div>

        </div>

    </div>

</div>

@endsection