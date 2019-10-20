<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Ativos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Inativos</a>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="table-responsive-xl">
            <table id="tabela" class="table table-striped">
                <div class="row">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Ações</th>
                        </tr>

                    </thead>
                </div>
                <div class="row">
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td scope="row">{{$cliente->nome }}</td>
                            <td>{{$cliente->cpf }}</td>
                            <td>{{$cliente->data_nascimento }}</td>
                            <td>{{$cliente->celnumero }}</td>
                            <td>{{$cliente->telefonenumero }}</td>
                            <td>
                                <a href="{{route('cliente.editar',$cliente->id)}}"><button type="button"
                                        class="btn btn-secondary">Editar</button></a>
                                <a href="{{route('cliente.deletar',$cliente->id)}}"><button type="button"
                                        class="btn btn-danger">Deletar</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="100%" class="text-center">
                                <p class="text-center">

                                    Página {{$clientes->currentPage()}} de {{$clientes->lastPage()}} páginas

                                </p>
                            </td>
                        </tr>
                        @if($clientes->lastPage() > 1)
                        <tr>
                            <td colspan="100%">
                                {{ $clientes->links() }}
                            </td>
                        </tr>
                        @endif
                    </tfoot>
                </div>
            </table>
        </div>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="table-responsive-xl">
            <table id="tabela" class="table table-striped">
                <div class="row">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Ações</th>
                        </tr>

                    </thead>
                </div>
                <div class="row">
                    <tbody>
                        @foreach ($clientesDeletados as $cliente)
                        <tr>
                            <td scope="row">{{$cliente->nome }}</td>
                            <td>{{$cliente->cpf }}</td>
                            <td>{{$cliente->data_nascimento }}</td>
                            <td>{{$cliente->celnumero }}</td>
                            <td>{{$cliente->telefonenumero }}</td>
                            <td>
                                <a href="{{route('cliente.deletar', $cliente->id)}}"><button type="button"
                                        class="btn btn-warning">Ativar</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="100%" class="text-center">
                                <p class="text-center">

                                    Página {{$clientesDeletados->currentPage()}} de {{$clientesDeletados->lastPage()}}
                                    páginas

                                </p>
                            </td>
                        </tr>
                        @if($clientesDeletados->lastPage() > 1)
                        <tr>
                            <td colspan="100%">
                                {{ $clientesDeletados->links() }}
                            </td>
                        </tr>
                        @endif
                    </tfoot>
                </div>
            </table>
        </div>

    </div>

</div>