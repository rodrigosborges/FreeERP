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
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Situação</th>
                        <th>Observação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infos as $info)
                    <?php 
                        $data = new DateTime($info->created_at);
                    ?>
                    <tr>

                        <td>{{$data->format('d/m/Y')}}</td>
                        <td>{{$data->format('H:i')}}</td>
                        <td>{{$info->situacao}}</td>
                        <td>{{$info->obs}}</td>
                        <td>
                            <a href="{{route('consertos.excluirInfo', $info->id)}}"><button class="btn btn-outline-danger">Excluir</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="100%" class="text-center">
                        <p class="text-center">
                            Página {{$infos->currentPage()}} de {{$infos->lastPage()}} páginas

                        </p>
                    </td>
                </tr>
                @if($infos->lastPage() > 1)
                <tr>
                    <td colspan="100%">
                        {{ $infos->links() }}
                    </td>
                </tr>
                @endif
                </tfoot>
                
            </table>
        </div>
        
            
        


    </div>
</div>

@stop