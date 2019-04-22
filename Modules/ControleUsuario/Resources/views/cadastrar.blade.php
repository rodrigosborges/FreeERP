@extends('template')
@section('title', 'Cadastrar')

@section('content')
<div class="d-flex p-2 bd-highlight col justify-content-center border rounded">

    <div class="p-2 bd-highlight col justify-content-center text-center border rounded">
        <form action="#" method="POST">
            {{ csrf_field() }}

            <div>
                <h4>Dados Cadastrais</h4>
            </div>

            <!-- Imagem adicionada diretamente do google, necessita sobescrever quando o usuario ja tiver -->
            <div class="form-group rounded-circle">
                <i class="material-icons" style="font-size: 80px;">
                        account_circle
                </i>
                <small id="fotoHelp" class="form-text text-muted">Imagem usu&aacute;rio</small>
            </div>

            <div class="form-group">
                <label for="nome">Nome de usu&aacute;rio</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome de usu&aacute;rio" required>
            </div>

            <div class="form-group">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" required>
                <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Senha" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar e Definir permiss&otilde;es</button>
            <button type="clear" class="btn btn-secundary">Limpar Dados</button>

        </form>
    </div>

    <div class="p-2 bd-highlight col justify-content-center text-center border rounded">
        <h4>Permiss&otilde;es</h4>
    </div>


</div>

@endsection
