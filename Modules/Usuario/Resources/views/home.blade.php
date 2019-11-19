@extends('usuario::layouts.informacoes')
@section('content')

<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10">
        @foreach($modulosAtivos as $modulo)       
        <!--Grid column-->
        <div class="col-md-6 mb-4">

            <!-- Card -->
            <div class="card gradient-card">

                <div class="card-image" style="background-color:#5f7885">

                    <!-- Content -->
                    <a href="#!">
                        <div class="text-white d-flex h-100 mask blue-gradient-rgba">
                        <div class="first-content align-self-center p-3">
                            <h3 class="card-title"><i class="material-icons">{{ $modulo->icone }}</i>     {{ $modulo->nome }}</h3>
                            <p class="lead mb-0">Clique aqui para acessar o módulo</p>
                        </div>
                        <div class="second-content align-self-center mx-auto text-center">
                            <i class="far fa-money-bill-alt fa-3x"></i>
                        </div>
                        </div>
                    </a>

                </div>

            </div>
            <!-- Card -->
        @endforeach

        </div>
        <!--Grid column-->

    </div>
</div>
@endsection