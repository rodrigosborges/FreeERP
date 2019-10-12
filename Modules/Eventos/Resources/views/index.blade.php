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
        
        .img{
            height: 260px;
            padding: 5px 5px 5px 5px;
            background-color: #000;
        }
        
        .info{
            padding: 5px 5px 5px 5px;
            background-color: #ddd;
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
            height: auto;
            width: auto;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
            <h1 style="text-align: center;">Próximos eventos</h1>
        </div>
    </div>

    <!-- BARRA DE PESQUISA -> ARRUMAR -->
    <div class="row">
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Pesquisar evento"/>
                    </div>
                    <div class="col">
                        <select name="selecionarEstado" class="form-control">
                            <option value="TD">Todos os estados</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="selecionarCidade" class="form-control">
                            <option value="TD">Todas as cidades</option>
                            <option value="AC">Caraguatatuba</option>
                        </select>
                    </div>
                    <div class="col" style="float: right;">
                        <button class="btn btn-primary d-flex" style="width: 268.5px; padding-left: 90px;"><i class="material-icons mr-2">search</i>Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- EVENTOS -->
    <div class="well">
        <div class="row">
            <div class="col exibeEvento">
                <div class="img">
                    <img src="">
                    
                </div>
                <div class="info">
                    <h2>Título evento</h2>
                    <p>xx/xx - Cidade/UF</p>
                </div>
            </div>
            <div class="col exibeEvento">

            </div>
            <div class="col exibeEvento">

            </div>
        </div>
    </div>
@endsection