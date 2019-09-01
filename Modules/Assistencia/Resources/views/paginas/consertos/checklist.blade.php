<div id="card">
    <div class="card-body">
        <div class="header">
            <div class="">
                <img class="img-fluid" src="{{ URL::to('/') }}/img/logo.png">
            </div>
            <div class="">
                <h4>Ordem de serviço nº {{$conserto->numeroOrdem}}</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6 col-md-12 row text-center">
                <div class="col-12">
                    <h5>Cliente</h5>
                    <hr>
                </div>

                <div class="col-6">
                    {{$conserto->cliente->nome}}
                </div>
                <div class="col-6">
                    {{$conserto->cliente->celnumero}}
                </div>
                <div class="col-6">
                    {{$conserto->cliente->cpf}}
                </div>
                <div class="col-6">
                    {{$conserto->cliente->telefonenumero}}
                </div>

            </div>
            <div class="col-lg-6 col-md-12 row  text-center">
                <div class="col-12">
                    <h5>Aparelho</h5>
                    <hr>
                </div>

                <div class="col-6">
                    Modelo: {{$conserto->modelo_aparelho}}
                </div>
                <div class="col-6">
                    Serial: {{$conserto->serial_aparelho}}
                </div>
                <div class="col-6">
                    Marca: {{$conserto->marca_aparelho}}
                </div>
                <div class="col-6">
                    IMEI: {{$conserto->imei_aparelho}}
                </div>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <h3>Checklist</h3>
        </div>
        <div class="row">
            <div class="col-12">
                <strong>Estado do aparelho:</strong>
            </div>
            <div class="col-12">
                (  ) Riscado (  ) Quebrado (  ) Arranhado (  ) Trincado (  ) Amassado <br>
            </div>
            <div class="col-12">
                Display danificado? (  )
            </div>
            <div class="col-12">
                Aparelho liga? (  ) ________
            </div>


        </div>
        <hr>
        <div class="row">
            Funcionamento - Os componentes do dispositivo estão funcionando corretamente? S ou N.
            (  ) Touch
            (  ) Lanterna/Flash
            (  ) Leitor de cartão de memória
            (  ) Leitor do SIM
            (  ) Antena de rede
            (  ) Antena Wifi/Bluetooth
            (  ) Sensor de proximidade
            (  ) Microfone
            (  ) Auto-falante
            (  ) Auricular
            (  ) Conector de carga
            (  ) Conector P2
            (  ) Botões
            (  ) Camera Traseira
            (  ) Camera frontal
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                Reclamação:
            </div>
            <div class="col-6">
                Observações:
            </div>
        </div>
    </div>
</div>