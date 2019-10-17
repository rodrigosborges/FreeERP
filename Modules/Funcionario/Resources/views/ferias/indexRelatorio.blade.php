@extends('funcionario::template')

@section('title','Relatórios')

@section('body')
<table class="table table-responsive-xl">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">Data de início do período</th>
            <th scope="col" style="text-align: center;">Data de término do período</th>
            <th scope="col">Calcular</th>
        </tr>
   </thead>
   <tbody>
        <tr>
            <form action="{{url('funcionario/ferias/listRelatorio')}}"  method="post">
                @csrf
                <td><input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{old('data_inicio')}}"></td>
                <td><input type="date" name="data_fim" id="data_fim" class="form-control" value="{{old('data_fim')}}"></td>
                <td><button type="submit"  class="btn btn-success ">Gerar</button></td>
            </form>
        </tr>
   </tbody>
</table>

@endsection