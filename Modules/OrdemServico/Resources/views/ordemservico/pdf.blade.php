<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <strong>Ordem de Seriço Nº:</strong>
                <span>{{$data['model']->id}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span>Data de abertura: {{$data['model']->created_at->format('d/m/Y H:i:s')}} </span>
            </div>
        </div>
        <table class="table table-bordered table-condensed">
            <tbody>
                <tr>
                    <td colspan="2">
                        <h6>
                            <strong>Solicitante </strong>
                        </h6>
                        <span>Nome : {{$data['model']->solicitante->nome}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                        <span>CPF/CPNJ : {{$data['model']->solicitante->id}}</span>
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <h6>
                            <strong>Contato</strong>
                        </h6>
                        <span>Email : {{$data['model']->solicitante->email}}</span>
                        <br>
                        @foreach($data['model']->solicitante->telefones as $telefone)
                        <span> Telefone: {{$telefone->numero}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>
                            <strong>Endereco</strong>
                        </h6>
                        <span>CEP : {{$data['model']->solicitante->endereco->cep}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Rua : {{$data['model']->solicitante->endereco->rua}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Bairro : {{$data['model']->solicitante->endereco->bairro}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Cidade : {{$data['model']->solicitante->endereco->cidade->nome}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Estado : {{$data['model']->solicitante->endereco->estado->abreviacao}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span>Numero : {{$data['model']->solicitante->endereco->numero}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Complemento : {{$data['model']->solicitante->endereco->complemento}} &nbsp;&nbsp;&nbsp;</span>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>
                            <strong>Aparelho</strong>
                        </h6>
                        <span>Numero de série : {{$data['model']->aparelho->numero_serie}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Tipo de Aparelho : {{$data['model']->aparelho->tipo_aparelho}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Marca : {{$data['model']->aparelho->marca}} &nbsp;&nbsp;&nbsp;</span>
                        <br>
                        <span>Modelo : {{$data['model']->aparelho->modelo}} &nbsp;&nbsp;&nbsp;</span>
                        <span>Acessórios : {{$data['model']->aparelho->acessorios}} &nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
                <tr>

                    <td colspan="2">
                        <h6>
                            <strong>Problema</strong>
                        </h6>
                        <span>Problema : {{$data['model']->problema->titulo}} &nbsp;&nbsp;&nbsp;</span>
                        <br>
                        <span>Descrição: {{$data['model']->descricao}} &nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="width:400px;border-top:1px solid ;margin-top:10%;margin-left:15%">
        <p>Assinatura Solicitante</p>
    </div>
    <div style="width:400px; border-top:1px solid ;margin-top:5%;margin-left:15%">
        <p>Assinatura Entregador</p>
    </div>
    
</body>

</html>