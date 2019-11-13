@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')
 <style>
 .form-control-borderless {
    border: none;
}

.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;

}
</style>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <form class="card">
                    <div class="card-body row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-search h4 text-body"></i>
                        </div>
                        <!--end of col-->
                        <div class="col">
                            <input class="form-control form-control-borderless" id="nomecliente" type="search" placeholder="Search topics or keywords">
                        </div>
                        <!--end of col-->
                        <div class="col-auto">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </div>
                        <!--end of col-->
                    </div>
                </form>
            </div>
        <!--end of col-->
            
    </div>
    
    <div class="row">
        <div class="col-12">
            <ul class="list-group " id="listaClientes">
                <li class="list-group-item disabled">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>   
        </div>
    
    </div>



</div>

@endsection
@yield('js')



<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function(){
        $('#nomecliente').keyup(function(){
            var valor = $('#nomecliente').val()
            buscarcliente(valor)
        })



        function buscarcliente(valor){
            $.ajax({
                url:'/buscacliente',
                type:'POST',
                data:{
                    valor:valor,
                    '_token': $('input[name=_token]').val(),
                }
            }).done(function(data){
                console.log(data)
            }).fail(function(){
                console.log('fail')
            }).always(function(){

            })
        }
        
    })
</script>


