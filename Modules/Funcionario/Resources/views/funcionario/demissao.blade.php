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
                        <option value="10">Escolha uma opção</option>
                        @foreach($data['tipo_demissao'] as $tipo_demissao)
                            <option value="{{$tipo_demissao->id}}" {{old('tipo_demissao') == $tipo_demissao->id ? 'selected' : ''}}>{{$tipo_demissao->tipo}}</option>
                        @endforeach
                    </select>
                </div>  

                <div class="form-group col-6" id="termino_contrato_experiencia" hidden>
                    <label for="termino_contrato_experiencia">Término do contrato de experiência</label>
                    <input type="date"  name="termino_contrato_experiencia" class="form-control" value="{{old('termino_contrato_experiencia')}}" placeholder="00/00/0000">
                </div>
            </div>
           
            <input type="hidden" name="funcionario_id" value="{{$data['funcionario']->id}}">
        </section>
        <hr>
        <section>
            <h4 class="text-center">Aviso prévio</h4>
           
                <div class='form-group col-3'>
                    <input type="checkbox" name="aviso_previo_indenizado" id="aviso_previo_indenizado"  {{old('aviso_previo_indenizado') ? 'checked' : null }} disabled>
                    <label for="aviso_previo_indenizado">Aviso previo indenizado</label>
                </div>

                <div class="form-group col-3">
                    <input type="checkbox" name="descontar_aviso_previo" id="descontar_aviso_previo" {{old('descontar_aviso_previo') ? 'checked' : null}} disabled>
                    <label for="descontar_aviso_previo">Desconta aviso previo</label>
                </div>

                <div class="form-group col-3">
                    <input type="checkbox" name="cumprir_aviso" id="cumprir_aviso" {{old('cumprir_aviso') ? 'checked' : null}} disabled>
                    <label for="cumprir_aviso">Cumprir aviso</label>
                </div>
               
                <div class="row">
                    <div class="form-group col-6">
                            <label for="tipo_cumprimento">Indicador de cumprimento de aviso prévio</label>
                            <select name="aviso_previo_indicador_cumprimento_id" class="form-control" id="aviso_previo_indicador_cumprimento_id" value="{{old('aviso_previo_indicador_cumprimento_id')}}"  disabled>
                            <option>Escolha uma opção</option>
                                @foreach($data['tipo_cumprimento'] as $tipo_cumprimento)
                                    <option value="{{$tipo_cumprimento->id}}" {{old('aviso_previo_indicador_cumprimento_id') == $tipo_cumprimento->id ? 'selected' : ''}}>{{$tipo_cumprimento->tipo_cumprimento}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="data_inicio_aviso">Data de início do aviso indenizado </label>
                        <input type="date" name="data_inicio_aviso" id="data_inicio_aviso" class="form-control" value="{{old('data_inicio_aviso')}}"  disabled>
                    </div>

                    <div class="form-group col-4">
                        <label for="tipo_reducao">Tipo de reducao do aviso</label>
                        <select name="tipo_reducao_aviso" class="form-control" id="tipo_reducao_aviso" value="{{old('tipo_reducao_aviso')}}"  disabled>
                            <option>Escolha uma opção</option>
                            <option value="Dias" {{old('tipo_reducao_aviso') == 'Dias' ? 'selected': ''}}>Dias</option>
                            <option value="Jornada" {{old('tipo_reducao_aviso') == 'Jornada' ? 'selected' : ''}}>Jornada</option>
                        </select>
                    </div>

                    <div class="form-group col-4">
                        <label for="dias_aviso_indenizado">Dias de aviso</label>
                        <input type="number" name="dias_aviso_indenizado" id="dias_aviso_indenizado" class="form-control" min="0" placeholder="Ex: 10" value="{{old('dias_aviso_indenizado')}}" disabled>
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
        
            function desabilitarAvisoPrevio(){
                document.getElementById('data_inicio_aviso').setAttribute('disabled', true);
                document.getElementById('dias_aviso_indenizado').setAttribute('disabled', true);
                document.getElementById('tipo_reducao_aviso').setAttribute('disabled', true);
                document.getElementById('aviso_previo_indicador_cumprimento_id').setAttribute('disabled', true);
            }

            function habilitarAvisoPrevio(){
                document.getElementById('data_inicio_aviso').removeAttribute('disabled', false);
                document.getElementById('dias_aviso_indenizado').removeAttribute('disabled', false);
                document.getElementById('tipo_reducao_aviso').removeAttribute('disabled', false);
                document.getElementById('aviso_previo_indicador_cumprimento_id').removeAttribute('disabled', false);
            }
            //Esse código serve para caso de erro de input digitado pelo usuário, faz com que toda a parte dos checkbos e inputs do aviso apareçam da forma como estava anteriormente.
            $(document).ready(function(){
                var check1 = document.getElementById('aviso_previo_indenizado');
                var check2 = document.getElementById('descontar_aviso_previo');
                var check3 = document.getElementById('cumprir_aviso');
                
                if(check1.checked){
                    check1.removeAttribute('disabled', false);
                    habilitarAvisoPrevio();
                }

                if(check2.checked){
                    check2.removeAttribute('disabled', false);
                    desabilitarAvisoPrevio();
                }

                if(check3.checked){
                    check3.removeAttribute('disabled', false);
                    habilitarAvisoPrevio();
                    
                }

                var tipoDemissao = document.getElementById('tipo_demissao').value;
                if(tipoDemissao == 1 || tipoDemissao == 2 || tipoDemissao == 3){
                    document.getElementById('termino_contrato_experiencia').removeAttribute('hidden', false);
                }
                

            })
            
            var tipoReducaoAviso = document.getElementById('tipo_reducao_aviso');
            tipoReducaoAviso.addEventListener('click', function(){
            if(tipoReducaoAviso.value == 'Jornada')
                document.getElementById('dias_aviso_indenizado').value = 23;
            })

            var tipoDemissao = document.getElementById('tipo_demissao');
            tipoDemissao.addEventListener('change', function(){
                var check1 = document.getElementById('aviso_previo_indenizado');
                var check2 = document.getElementById('descontar_aviso_previo');
                var check3 = document.getElementById('cumprir_aviso');

                if(this.value == 1 || this.value == 2 || this.value == 3)
                    document.getElementById('termino_contrato_experiencia').removeAttribute('hidden', false);
                else 
                    document.getElementById('termino_contrato_experiencia').setAttribute('hidden', true);


                if(this.value == 7){
                    check1.removeAttribute('disabled', false);
                    check1.checked = true;

                    check2.checked = false;
                    check2.setAttribute('disabled', true);

                    check3.checked = false;
                    check3.setAttribute('disabled', true);

                    desabilitarAvisoPrevio();

                } else if(this.value == 8 || this.value == 9){
                    
                    check1.checked = false;
                    check2.checked = false;
                    check3.checked = false;

                    check1.setAttribute('disabled', true);
                    check2.setAttribute('disabled', true);
                    check3.setAttribute('disabled', true);

                    desabilitarAvisoPrevio()

                } else if(this.value == 1 || this.value == 6){
                    
                    if(check1.checked)
                        check1.checked = false;
                    
                    check1.setAttribute('disabled', true);
                    check2.removeAttribute('disabled', false);
                    check3.removeAttribute('disabled', false);

                } else {
                    if(check2.checked){
                        check2.checked = false;
                        check2.setAttribute('disabled', true);
                    }
                    check1.removeAttribute('disabled', false);
                    check3.removeAttribute('disabled', false);
                    check2.setAttribute('disabled', true);
                }
            })

            document.getElementById('aviso_previo_indenizado').addEventListener('click', function(){
                var check2 = document.getElementById('descontar_aviso_previo');
                var check3 = document.getElementById('cumprir_aviso');

                habilitarAvisoPrevio();

                if(check2.checked)
                    check2.checked = false;
                
                if(check3.checked)
                    check3.checked = false;
            })

            document.getElementById('descontar_aviso_previo').addEventListener('click', function(){
                var check3 = document.getElementById('cumprir_aviso');

                desabilitarAvisoPrevio();

                if(check3.checked)
                    check3.checked = false;
            })

            document.getElementById('cumprir_aviso').addEventListener('click', function(){
                var check1 = document.getElementById('aviso_previo_indenizado');
                var check2 = document.getElementById('descontar_aviso_previo');

               habilitarAvisoPrevio();

                if(check1.checked)
                    check1.checked = false;
                
                if(check2.checked)
                    check2.checked = false;
            })
    </script>
@endsection

