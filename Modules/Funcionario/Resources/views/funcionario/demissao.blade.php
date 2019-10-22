@extends('funcionario::template')

@section('title', 'Aviso prévio e demissão')

@section('body')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    @endif
    <form method="post" action="{{url('funcionario/storeDemissao')}}">
    @csrf
        <section>
            <h4 style="text-align: center;">Demissão</h4>
            <div class="row">
                <div class="form-group col-6">
                    <label for="data_demissao">Data Demissão:</label>
                    <input type="date" name="data_demissao" id="data_demissao" class="form-control" value="{{old('data_demissao')}}">    
                </div>

                <div class="form-group col-6">
                    <label for="data_pagamento">Data pagamento: </label>
                    <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" value="{{old('data_pagamento')}}">
                </div>

                <div class="form-group col-6">
                <label for="tipo_demissao">Tipo de demissão: </label>
                    <select name="tipo_demissao" id="tipo_demissao" class="form-control">
                        <option>Escolha uma opção</option>
                        @foreach($data['tipo_demissao'] as $tipo_demissao)
                            <option value="{{$tipo_demissao->id}}" {{old('tipo_demissao') == $tipo_demissao->id ? 'selected' : ''}}>{{$tipo_demissao->tipo}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>
           
           
            <input type="hidden" name="funcionario_id" value="{{$data['funcionario']->id}}">
        </section>
        <hr>
        <section>
            <h4 style="text-align: center;">Aviso prévio</h4>
            
                <div class='form-group col-6'>
                    <input type="checkbox" name="aviso_previo_indenizado" id="aviso_previo_indenizado"  {{old('aviso_previo_indenizado') ? 'checked' : null }} disabled>
                    <label for="aviso_previo_indenizado">Aviso previo indenizado</label>
                </div>

                <div class="form-group col-3">
                    <input type="checkbox" name="descontar_aviso_previo" id="descontar_aviso_previo" {{old('descontar_aviso_previo') ? 'checked' : null}} disabled>
                    <label for="descontar_aviso_previo">Desconta aviso previo</label>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="data_inicio_aviso">Data de início do aviso indenizado </label>
                        <input type="date" name="data_inicio_aviso" id="data_inicio_aviso" class="form-control" value="{{old('data_inicio_aviso')}}"disabled>
                    </div>

                    <div class="form-group col-4">
                        <label for="tipo_reducao">Tipo de reducao do aviso</label>
                        <select name="tipo_reducao_aviso" class="form-control" id="tipo_reducao_aviso" value="{{old('tipo_reducao_aviso')}}" disabled>
                            <option>Escolha uma opção</option>
                            <option value="Dias" {{old('tipo_reducao_aviso') == 'Dias' ? 'selected': ''}}>Dias</option>
                            <option value="Jornada" {{old('tipo_reducao_aviso') == 'Jornada' ? 'selected' : ''}}>Jornada</option>
                        </select>
                    </div>

                    <div class="form-group col-4">
                        <label for="dias_aviso_indenizado">Dias de aviso indenizado </label>
                        <input type="number" name="dias_aviso_indenizado" id="dias_aviso_indenizado" class="form-control" min="0" placeholder="Ex: 10" value="{{old('dias_aviso_indenizado')}}" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                            <label for="tipo_cumprimento">Indicador de cumprimento de aviso prévio</label>
                            <select name="aviso_previo_indicador_cumprimento_id" class="form-control" id="aviso_previo_indicador_cumprimento_id" value="{{old('aviso_previo_indicador_cumprimento_id')}}" disabled>
                            <option>Escolha uma opção</option>
                                @foreach($data['tipo_cumprimento'] as $tipo_cumprimento)
                                    <option value="{{$tipo_cumprimento->id}}" {{old('aviso_previo_indicador_cumprimento_id') == $tipo_cumprimento->id ? 'selected' : ''}}>{{$tipo_cumprimento->tipo_cumprimento}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
        </section>

@section('footer')
    <div class="d-flex justify-content-end">
        <button type="submit"  class="btn btn-success ">Salvar</button>
    </div>
    </form>
@endsection


@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        var tipoReducaoAviso = document.getElementById('tipo_reducao_aviso');
        tipoReducaoAviso.addEventListener('click', function(){
            if(tipoReducaoAviso.value == 'Jornada')
                document.getElementById('dias_aviso_indenizado').value = 23;
        })

        /**Esse código é usado quando  a página apresenta algum erro de inserção nos dados, e o checkbox que desmarca o disabled
        os campos disabled está marcado anteriormente. Nesse caso, os disabled são removidos novamente, pois o default dos campos é com "disabled"*/
        $(document).ready(function(){
            var check = document.getElementById('aviso_previo_indenizado');
            if(check.checked){
                check.removeAttribute('disabled', false);
                document.getElementById('data_inicio_aviso').removeAttribute('disabled', false);
                document.getElementById('dias_aviso_indenizado').removeAttribute('disabled', false);
                document.getElementById('tipo_reducao_aviso').removeAttribute('disabled', false);
                document.getElementById('aviso_previo_indicador_cumprimento_id').removeAttribute('disabled', false);
            }
        })
        
        //Código de ativar/desativar disableds.
        var tipoDemissao = document.getElementById('tipo_demissao');
            tipoDemissao.addEventListener('change', function(){
                var check1 = document.getElementById('aviso_previo_indenizado');
                var check2 = document.getElementById('descontar_aviso_previo');

                if(this.value == 1 || this.value == 6){
                    check2.removeAttribute('disabled', false);
                    
                    //Pega todos os inputs com disabled default e tornam disabled novamente, caso a outra opção do checkbox esteja selecionada.
                    document.getElementById('data_inicio_aviso').setAttribute('disabled', true);
                    document.getElementById('dias_aviso_indenizado').setAttribute('disabled', true);
                    document.getElementById('tipo_reducao_aviso').setAttribute('disabled', true);
                    document.getElementById('aviso_previo_indicador_cumprimento_id').setAttribute('disabled', true);
                    
                    if(!(check2.checked))
                        check2.checked = true;
                    
                    if(check1.checked){
                        check1.checked = false;
                        check1.setAttribute('disabled', true);
                    }

                } else {
                    check1.removeAttribute('disabled', false);
                    
                    //Pega todos os inputs com disabled e os "destrancam"
                    document.getElementById('data_inicio_aviso').removeAttribute('disabled', false);
                    document.getElementById('dias_aviso_indenizado').removeAttribute('disabled', false);
                    document.getElementById('tipo_reducao_aviso').removeAttribute('disabled', false);
                    document.getElementById('aviso_previo_indicador_cumprimento_id').removeAttribute('disabled', false);

                    if(!(check1.checked))
                        check1.checked = true;

                    if(check2.checked){
                        check2.checked = false;
                        check2.setAttribute('disabled', true);
                    }    
                }  
            })
    </script>
@endsection

