@extends('funcionario::template')

@section('title','Relatório')

@section('body')
<div id="ficha">
    <table class="table table-hover">
    <thead  class="thead-dark">
        <tr>
        <th scope="col">Nome</th>
        <th scope="col">Dia inicial</th>
        <th scope="col">Dia Final</th>
        <th scope="col">Valor</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($dadosRelatorio as $dados)
        <tr>
        <td> {{ $dados->nome }} </td>
        <td> {{ \Carbon\Carbon::parse($dados->data_inicio)->format('d/m/Y') }} </td>
        <td> {{ \Carbon\Carbon::parse($dados->data_fim)->format('d/m/Y') }} </td>  
        <td> {{  number_format($dados->total, 2, ',', '.')}}</td> 
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@section('footer')
    <div class="text-right">
    <a class="btn btn-success" href="{{url('funcionario/ferias/indexRelatorio')}}">Voltar</a>
    <button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
    </div>
@endsection
@endsection

@section('js')
<script src="{{Module::asset('funcionario:js/bibliotecas/printThis.js')}}"></script>

<script>
    $(document).on('click','.imprimir-button', function(){
        $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
        $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
        var dNow = new Date();
        var day = dNow.getDate() < 10 ? "0"+dNow.getDate() : dNow.getDate()
        var month = dNow.getMonth() < 9 ? "0"+dNow.getMonth() : dNow.getMonth()
        var hours = dNow.getHours() < 10 ? "0"+dNow.getHours() : dNow.getHours()
        var minutes = dNow.getMinutes() < 10 ? "0"+dNow.getMinutes() : dNow.getMinutes()
        var localdate = day + '/' + month + '/' + dNow.getFullYear() + ' ' + hours + ':' + minutes;

        $("#ficha").printThis({
            header: "<h1 class='text-center'>Relatório de férias<h1><hr><br>",
            // footer: `<span class='text-center bottom-center-absolute titulo_cargo'>${localdate}<span><hr><br>`,
            afterPrint: function(){
                $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
                $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
            }
        });
    })
</script>
@endsection