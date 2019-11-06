<div class="table-responsive">
    <table id="tabela" class="table table-striped text-center">
        <div class="row">
            <thead>
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Aparelho</th>
                    <th scope="col">Valor a ser pago</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </div>
        <div class="row">
            <tbody>
                @foreach ($consertos as $conserto)
                <tr>
                    <td scope="row">{{$conserto->numeroOrdem }}</td>
                    <td>{{$conserto->cliente->nome }}</td>
                    <td>{{$conserto->modelo_aparelho }}</td>
                    <td>R$ {{ $conserto->valor  - $conserto->sinal}}</td>
                    <td>
                        <a href="{{route('consertos.verMais', $conserto->id)}}"><button type="button"
                                class="btn btn-primary">Ver mais</button></a>
                        <a href="{{route('consertos.visualizar', $conserto->id)}}"><button type="button"
                                class="btn btn-outline-primary">Vizualizar</button></a>
                        <a href="{{route('consertos.editar', $conserto->id)}}"><button type="button"
                                class="btn btn-dark">Editar</button></a>
                        <a href="{{route('consertos.finalizar', $conserto->id)}}"><button type="button"
                                class="btn btn-outline-success">Finalizar</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="100%" class="text-center">
                        <p class="text-center">
                            Página {{$consertos->currentPage()}} de {{$consertos->lastPage()}} páginas

                        </p>
                    </td>
                </tr>
                @if($consertos->lastPage() > 1)
                <tr>
                    <td colspan="100%">
                        {{ $consertos->links() }}
                    </td>
                </tr>
                @endif
            </tfoot>
        </div>
    </table>
</div>