@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        
        <!-- Verifica se a variável 'eventoId' está vazia/nula para selecionar o evento -->
        @if(empty($eventoId))
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <h1 style="text-align: center;">Pessoas</h1>
            <form method="post" action="/eventos/exibePessoas"  >
                {{ csrf_field() }}
                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleFormControlSelect1">Selecione o evento</label>
                    <select class="form-control" name="eventoSelecionado">
                        @foreach ($eventos as $evento)
                            <option value="{{$evento->id}}">{{$evento->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Ok</button>
            </form>  
        </div>
        
        @else
        <h1 style="text-align: center;">Pessoas</h1>
        <table id="pessoas" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Telefone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evento_pessoas as $evento_pessoa)
                    <tr>
                        <td class="text-center">{{$evento_pessoa->nome}}</td>
                        <td class="text-center">{{$evento_pessoa->email}}</td>
                        <td class="text-center">{{$evento_pessoa->telefone}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    	
    <script>
        $(document).ready(function(){
            $('#pessoas').DataTable({
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });
        });
    </script>
@endsection
