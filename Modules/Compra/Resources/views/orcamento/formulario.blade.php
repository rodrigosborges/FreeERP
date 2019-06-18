@extends('template')
@section('content')

<h1>Itens solicitados</h1>
<form>
    <!--<div class="row ml-3 mr-3">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                                <input type="text" class="form-control" aria-label="Text input with radio button" placeholder=" Mesas de Sala de Aula"  disabled>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Qtd</span>
                                    </div>
                                <input type="text" class="form-control col-2" aria-label="Sizing example input" placeholder="55" disabled>                                 
                            </div>
                        </li>
                        <li class="list-group-item">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Valor Total</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> 
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                                <input type="text" class="form-control" aria-label="Text input with radio button" placeholder=" Mesas de Sala de Aula"  disabled>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Qtd</span>
                                    </div>
                                <input type="text" class="form-control col-2" aria-label="Sizing example input" placeholder="55" disabled>                                 
                            </div>
                        </li>
                        <li class="list-group-item">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Valor do(s) iten(s)</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> 
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
-->
<!--
<div class="card col-8 mb-3">
    <div class="card-body">
        <div class="input-group">
            <div class="input-group-prepend">
      
                <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
            </div>
                <input type="text" class="form-control" aria-label="Text input with radio button" placeholder=" Mesas de Sala de Aula"  disabled>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Qtd</span>
                    </div>
                <input type="text" class="form-control col-1" aria-label="Sizing example input" placeholder="55" disabled> 
                                             
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Valor Total</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> 
        </div>
    </div>               
</div>
-->
<div class="card col-8 mb-3">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCity">Nome do Produto</label>
                <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="Mesa de Marmore"  disabled>
            </div>
            <div class="form-group col-md-1">
                <label for="inputState">Quantidade</label>
                <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="55"  disabled>
            </div>
            <span class="col-md-1"></span>
            <div class="form-group col-md-3">
                <label for="inputZip">Valor Total</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
        </div>
    </div>               
</div>

</form>
@endsection