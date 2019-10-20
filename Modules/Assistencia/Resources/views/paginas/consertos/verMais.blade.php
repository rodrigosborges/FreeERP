@extends('assistencia::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row ">
            <div class="col-12">
                <a href="{{route('consertos.localizar')}}"><i class="material-icons mr-2">home</i></button></a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Data</th>
                    <th>Situação</th>
                    <th>Observação</th>
                </tr>
                @foreach($infos as $info)
                <tr>
                    <td>{{$info->created_at}}</td>
                    <td>{{$info->situacao}}</td>
                    <td>{{$info->obs}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
            
        


    </div>
</div>

@stop