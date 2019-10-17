@extends('funcionario::template')

@section('title', 'Aviso prévio do empregador para dispensa do empregado')
@section('body')

    <div id="ficha d-flex justify-content-center">
        
        <div class="row d-flex justify-content-center">
            <div class="">
                <h4 class="font-weight-bold">Aviso prévio do empregador para dispensa do empregado</h4>
            </div>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="d-flex">
                <p>{{$data['dia_atual']}}.</p>    
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-10 justify-content-justify ">
                <p class="font-weight-bold">A <br>Sr(a) {{$data['nome']}}</p>  
                <p>Pelo presente o(a) notificamos que a partir de <span class="font-weight-bold">{{$data['demissao']}}</span>, não serão utilizados os seus 
                serviços por nossa empresa, e por isso, vimos avisá-lo nos termos e para os efeitos do disposto no Art. 487 II da CLT que a partir desta 
                data estamos rescindindo seu contrato de trabalho. Pedimos a devolução do presente com o seu "CIENTE".<br><br>Atenciosamente, </p>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <p style="border-top: solid 1px">Assinatura da Empresa</p>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-10 justify-content-justify">
                <p>Ciente:</p>
                <p class="font-weight-bold" style="border-top: solid 1px">{{$data['nome']}}</p>
            </div>

        </div>
    </div>

    @section('footer')
    <div class="text-right">
    <a class="btn btn-success" href="{{url('funcionario/funcionario')}}">Voltar</a>
    <a class="btn btn-danger" href='{{url("funcionario/destroyDemissao/$data[id]")}}'>Excluir Demissão</a>
    <button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
</div>
@endsection
@endsection
@section('script')
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
            header: "<h1 class='text-center'>Aviso prévio do empregador para dispensa do empregado<h1><hr><br>",
            // footer: `<span class='text-center bottom-center-absolute titulo_cargo'>${localdate}<span><hr><br>`,
            afterPrint: function(){
                $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
                $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
            }
        });
    })
</script>
@endsection