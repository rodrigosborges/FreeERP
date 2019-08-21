@extends('template')
@section('title', 'Exemplo')

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <form>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="pessoa_fisica" id="pessoa_fisica" autocomplete="off" checked> Pessoa Fisica
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="pessoa_juridica" id="pessoa_juridica" autocomplete="off"> Pessoa Juridica
                </label>
                </div>
                
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Ex: Raimundo Nonato">
                </div>
                
                <div class="form-group">
                    <label for="numero_documento">Número de Documentação</label>
                    <input type="text" class="form-control" id="numero_documento" placeholder="Ex: 461.305.874-55">
                </div>
                <div class="form-group">
                    <label for="comprovante">Comprovante</label>
                    <input type="text" class="form-control" id="comprovante" placeholder="Ex: 461.305.874-55">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Clique em mim</label>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>    
        </div>
    </div>
@endsection