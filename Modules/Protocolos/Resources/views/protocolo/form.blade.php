@extends('protocolos::template')

@section('title','Cadastrar Processo Eletrônico')

@section('body')

    <form id="form" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9">
                <div class="form-group">
                    <label for="nome" class="control-label">Interessados: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">person</i>
                            </span>
                        </div>
                        <select required name="funcionario[id]" class="form-control">
                            <option value="">Selecione</option>
                            <!--colocar o foreach -->
                                <option value=""> </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Tipo de processo: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">person</i>
                            </span>
                        </div>
                        <select required name="funcionario[id]" class="form-control">
                            <option value="">Selecione</option>
                            <!--colocar o foreach -->
                                <option value=""> </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Assunto: <span class="required-symbol">*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Nível de acesso: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">person</i>
                            </span>
                        </div>
                        <select required name="funcionario[id]" class="form-control">
                            <option value="">Selecione</option>
                            <!--colocar o foreach -->
                                <option value=""> </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="text-right">
                    <button class="btn btn-success sendForm" type="button">Salvar</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{Module::asset('protocolo:js/views/protocolo/index.js')}}"></script>
@endsection