@extends('estoquemadeireira::layouts.master')
@section('title', 'Produtos')
@section('content')

<div class="container">
    <div class="card col-md-12">
        <div class="card"> 

            
        
        </div>
    
    
    </div>

    <div class="nav nav-tabs justify-content-center">
        <li class="nav-item">
        <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab"> 
            @if($flag == 1)
                <h5>Produtos Inativos</h5>
            @else
                <h5>Produtos Ativos</h5>
            @endif
            
        </a>

        </li>
    
    </div>





</div>



@stop