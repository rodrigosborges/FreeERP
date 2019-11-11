<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Calendario\Entities\Funcionario;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe os eventos na página inicial do calendário
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Recupera o usuário logado e suas agendas
        $funcionario = Funcionario::where('user_id', Auth::id())->first();
        $agendas = $funcionario->agendas;

        //Recupera as agendas que estão compartilhadas com o setor do usuário
        $agendas_setor = new Collection();
        $compartilhamentos = $funcionario->setor->compartilhamentos;

        //Verifica se a agenda compartilhada já possui aprovação e a recupera
        foreach ($compartilhamentos as $compartilhamento) {
            if ($compartilhamento->agenda)
                if ($compartilhamento->aprovacao && $compartilhamento->agenda->funcionario->id != $funcionario->id)
                    //Esconde a agenda compartilhada do próprio dono (para não duplicar os eventos)
                    $agendas_setor->add($compartilhamento->agenda);
        }

        //Retorna para a view index (primeira tela do sistema)
        return view('calendario::index', ['agendas' => $agendas, 'agendas_setor' => $agendas_setor, 'setor' => $funcionario->setor->sigla]);
    }
}
