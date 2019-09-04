@extends('template')
@section('title', 'Produtos em Estoque')
@section('content')
<div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h5>Produtos em estoque</h5>
            </div>
            <div class="card-body">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link  active" href="#">Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Relatorios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info " href="#">Tipos de Unidade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info " href="#">configurações</a>
                </li>
            </ul>
            <table class="table text-center ">
            <thead class="">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope='col'>Ações</th>
                    <th>
                        <a class="btn btn-success btn-md" href="{{url('/estoque/produto/categoria/create')}}">
                            <i class="material-icons">note_add</i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a class="btn btn-lg btn-warning" href="">
                            <i class="material-icons">border_color</i>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-lg btn-danger">

                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="100%" class="text-center">
                        <p class="text-cetner">

                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="100%" class="text-center">

                    </td>
                </tr>

            </tfoot>
        </table>

            </div>
                <div class="card-footer">


                </div>

        </div>
    </div>



@endsection
