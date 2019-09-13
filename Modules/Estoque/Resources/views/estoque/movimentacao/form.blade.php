@extends('estoque::template')
@section('title', 'Cadastro de Produto')

@section('content')

    
    <div class="container" style="justify-content: center">
    <div class="card">
        <div class="card-header">
        @if($flag == 1)
            Adicionar Estoque
        @else   
            Remover Estoque
        @endif
        </div>
        <div class="card-body">
        <form action="{{url('/estoque/movimentacao/alterar')}}" method="POST">
        @csrf
            <div class="row">
                    <div class="form-group col-6">
                        <label for="preco_custo">Preço de Custo</label>
                        @if($flag == 1)
                            <input type="text" class="form-control"  required name="preco_custo" onKeyUp="moeda(this);">
                        @else
                            <input type="text" disabled value="0.00" class="form-control" name="preco_custo" onKeyUp="moeda(this);">
                        @endif
                    </div>
                <div class="form-group col-6">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" class="form-control" required name="quantidade">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-12">
                     <label for="observacao">Observação</label>
                     <textarea name="observacao" class="form-control" id="" required maxlength="200"></textarea>
                </div>
            </div>
            <input type="text" hidden name="estoque_id" value="{{$estoque->id}}">
            <input type="text" hidden name="flag" value="{{$flag}}">

            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm ">Enviar</button>
                </div>
            </div>
            
        </form>  
        </div>
    </div>
    </div>  

@endsection
<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
    </script>