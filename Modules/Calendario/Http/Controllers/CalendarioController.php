<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Calendario\Entities\Convite;
use Modules\Calendario\Entities\Funcionario;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $funcionario = Funcionario::where('user_id', Auth::id())->first();
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
