@extends('template')
@section('title', 'Cadastrar')

@section('content')
<div class="d-flex p-2 bd-highlight col justify-content-center border rounded">

        <form action="#" method="POST">
            {{ csrf_field() }}

            <!-- Imagem adicionada diretamente do google, necessita sobescrever quando o usuario ja tiver -->
            <div class="form-group text-center rounded-circle">
                <i class="material-icons" style="font-size: 80px; ">
                        account_circle
                </i>
            </div>

            <div class="form-group text-center">
                <label for="nome">Nome de usu&aacute;rio</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome de usu&aacute;rio" required>
            </div>

            <div class="form-group text-center">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" required>
                <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
            </div>

            <div class="form-group text-center">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Senha" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1" required>Clique em mim</label>
            </div>
            <button type="submit" class="btn btn-primary">Definir permiss&otilde;es</button>
        </form>

</div>

@endsection
