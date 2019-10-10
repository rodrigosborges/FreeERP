<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Calendario\Entities\Compartilhamento;
use Modules\Calendario\Entities\Funcionario;

class CalendarioController extends Controller
{
    public function index()
    {
        //TODO Get agendas do funcinário logado
        $funcionario = Funcionario::find(1);

        $agendas = $funcionario->agendas;
        $agendas_setor = new Collection();
        $compartilhamentos = $funcionario->setor->compartilhamentos;

        foreach ($compartilhamentos as $compartilhamento) {
            if ($compartilhamento->agenda)
                if ($compartilhamento->aprovacao && $compartilhamento->agenda->funcionario->id != $funcionario->id)
                    $agendas_setor->add($compartilhamento->agenda);
        }
        return view('calendario::index', ['agendas' => $agendas, 'agendas_setor' => $agendas_setor, 'setor' => $funcionario->setor->sigla]);
    }
}
