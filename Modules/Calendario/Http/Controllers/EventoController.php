<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Convite;
use Modules\Calendario\Entities\Evento;
use Modules\Calendario\Entities\Funcionario;
use Modules\Calendario\Entities\Notificacao;
use Modules\Calendario\Entities\User;
use Modules\Calendario\Http\Requests\EventoSalvarRequest;
use Modules\Calendario\Notifications\NotificarAlteracaoEvento;
use Modules\Calendario\Notifications\NotificarConviteParaEvento;
use Modules\Calendario\Notifications\NotificarEventoProximo;

/**
 * Class EventoController
 * @package Modules\Calendario\Http\Controllers
 */
class EventoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function notificar()
    {

        User::find(1)->notify(new NotificarEventoProximo(Evento::find(1)));
    }

    /**
     * Recupera todos eventos que o usuário possui vínculo
     *
     * @return array
     */
    public function eventos()
    {
        $eventos = [];

        //Recupera o usuário logado e suas agendas
        $funcionario = Funcionario::where('user_id', Auth::id())->first();
        $agendas = $funcionario->agendas;

        //Recupera os eventos de agendas do próprio usuário
        foreach ($agendas as $agenda) {
            $eventos = array_merge($eventos, $agenda->eventos_json);
        }

        //Recupera os eventos das agendas compartilhadas com o setor do usuário
        $compartilhamentos = $funcionario->setor->compartilhamentos;
        foreach ($compartilhamentos as $compartilhamento) {
            if ($compartilhamento->aprovacao && $compartilhamento->agenda->funcionario->id != $funcionario->id) {
                $eventos = array_merge($eventos, $compartilhamento->agenda->eventos_json);
            }
        }

        //Recupera os eventos que o usuário foi convidado e confirmou presença
        $convites = Convite::where('funcionario_id', $funcionario->id)->where('status', true)->whereHas('evento', function (Builder $query) {
            $query->whereHas('agenda', function (Builder $query) {
                $query->where('deleted_at', '=', null);
            });
        })->get();

        //Converte os eventos que estão como collection para um json (formato que o calendário processa)
        foreach ($convites as $convite) {
            array_push($eventos, $convite->evento_json);
        }

        return $eventos;
    }

    /**
     * Cria um evento novo ou edita um já existente
     *
     * @param Evento|null $evento
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function criarOuEditar(Evento $evento = null, Request $request)
    {
        //Verifica se o usuário tentando editar o evento é o criador
        if ($evento)
            if (!Auth::user()->is($evento->agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        //Recupera a rota
        $rota = $request->route()->getName();

        //Salva a origem da requisição para depois retornar
        session()->flash('evento_origem', url()->previous());

        //Recupera todas agendas do usuário
        $agendas = Agenda::where('funcionario_id', Auth::id())->orderBy('titulo')->get();

        //Recupera todos usuários do sistema (para possível convite ao evento)
        $funcionarios = Funcionario::all();

        //Recupera a indicação da agenda enviada pela URL
        $agenda_selecionada = $request->agenda;

        //Retorna para a view  eventos.criar-editar passando os dados recuperados
        return view('calendario::eventos.criar-editar', ['agendas' => $agendas, 'evento' => $evento, 'funcionarios' => $funcionarios, 'agenda_selecionada' => $agenda_selecionada, 'rota' => $rota]);
    }

    /**
     *  Salva no BD um novo evento
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(EventoSalvarRequest $request)
    {
        try {
            //Cria um objeto para o evento e o preenche com os dados recebidos do formulário
            $evento = new Evento();
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = $this->formatar_data($request->eventoDataInicio);
            $evento->data_fim = $this->formatar_data($request->eventoDataFim);
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;
            $agenda = Agenda::find($request->eventoAgenda);
            $evento->agenda()->associate($agenda);
            $evento->save();

            //Cria um objeto para a notificação caso o usuário tenha selecionado para ser notificado
            if ($request->eventoNotificacaoTempo && $request->eventoNotificacaoPeriodo) {
                $notificacao = new Notificacao();
                $notificacao->evento()->associate($evento);
                $notificacao->tempo = $request->eventoNotificacaoTempo;
                $notificacao->periodo = $request->eventoNotificacaoPeriodo;
                $notificacao->email = $request->eventoNotificacaoEmail;
                $notificacao->save();
            }

            //Cria um objeto para cada convite (se houver) ao evento e associa com o convidado
            if ($request->eventoConvite) {
                foreach ($request->eventoConvite as $funcionario_id) {
                    $convite = new Convite();
                    $convite->funcionario()->associate(Funcionario::find($funcionario_id));
                    $convite->evento()->associate($evento);
                    $convite->save();

                    //Envia notificação (por e-mail) para o convidado
                    $convite->funcionario->user->notify(new NotificarConviteParaEvento($convite));
                }
            }
            //Retorna à URL de origem salva na session
        } catch (\Exception $e) {
            return redirect(session('evento_origem'))->with('error', 'Falha ao criar evento. Erro: ' . $e->getMessage());
        }
        return redirect(session('evento_origem'))->with('success', 'Evento criado com sucesso.');
    }

    /**
     * Atualiza um evento já existente
     *
     * @param Request $request
     * @param Evento $evento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function atualizar(EventoSalvarRequest $request, Evento $evento)
    {
        //Verifica se o usuário tentando editar o evento é o criador
        if ($evento)
            if (!Auth::user()->is($evento->agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        //Recupera os dados do formulário e preenche o objeto do evento
        try {
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = $this->formatar_data($request->eventoDataInicio);
            $evento->data_fim = $this->formatar_data($request->eventoDataFim);
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;

            //Verifica se ainda há notificação e atualiza, ou deleta caso não tenha mais
            if ($evento->notificacao) {
                if ($request->eventoNotificacaoTempo && $request->eventoNotificacaoPeriodo) {
                    $evento->notificacao->tempo = $request->eventoNotificacaoTempo;
                    $evento->notificacao->periodo = $request->eventoNotificacaoPeriodo;
                    $evento->notificacao->email = $request->eventoNotificacaoEmail;
                    $evento->notificacao->save();
                } else {
                    $evento->notificacao()->delete();
                }
            } else {
                //Cria uma nova notificação
                if ($request->eventoNotificacaoTempo && $request->eventoNotificacaoPeriodo) {
                    $notificacao = new Notificacao();
                    $notificacao->evento()->associate($evento);
                    $notificacao->tempo = $request->eventoNotificacaoTempo;
                    $notificacao->periodo = $request->eventoNotificacaoPeriodo;
                    $notificacao->email = $request->eventoNotificacaoEmail;
                    $notificacao->save();
                }
            }
            //Procura no BD os convites já existentes, ou cria caso seja um convite novo
            $convites = [];
            if ($request->eventoConvite) {
                foreach ($request->eventoConvite as $funcionario_id) {
                    $convites[] = Convite::firstOrCreate([
                        'evento_id' => $evento->id,
                        'funcionario_id' => $funcionario_id
                    ]);
                }
            }
            //Compara os convites já existentes com os recuperados/criados anteriormente
            foreach ($evento->convites as $evento_convite) {
                $achou = false;
                foreach ($convites as $convite) {
                    //Envia notificação de convite caso seja um convite novo
                    if ($convite->wasRecentlyCreated)
                        $convite->funcionario->user->notify(new NotificarConviteParaEvento($convite));
                    else
                        //Envia notificação de alteração de convite caso já tenha sido aprovado pelo convidado
                        if ($convite->status == true)
                            $convite->funcionario->user->notify(new NotificarAlteracaoEvento($convite));
                    //Define uma variável de controle para os convites que já existiam
                    if ($convite->is($evento_convite))
                        $achou = true;
                }
                //Apaga os convites do BD caso tenham sido removidos do formulário
                if (!$achou)
                    $evento_convite->delete();
            }
            $evento->save();
        } catch (\Exception $e) {
            return redirect(session('evento_origem'))->with('error', 'Falha ao atualizar evento "' . $request->eventoNome . '". Erro: ' . $e->getMessage());
        }
        return redirect(session('evento_origem'))->with('success', 'Evento "' . $request->eventoTitulo . '" atualizado com sucesso.');
    }

    /**
     * Deleta permanentemente um evento
     *
     * @param Evento $evento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletar(Evento $evento)
    {
        //Verifica se o usuário tentando deletar o evento é o criador
        if ($evento)
            if (!Auth::user()->is($evento->agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        $origem = session('evento_origem');

        //Verifica se há origem (tela inicial) e retorna para ela, ou então para os eventos da agenda
        if($origem)
            $retorno = $origem;
        else
            $retorno = route('agendas.eventos.index', $evento->agenda->id);

        try {
            $evento->delete();
        } catch (\Exception $e) {
            return redirect($retorno)->with('error', 'Falha ao deletar evento. Erro: ' . $e->getCode());
        }
        return redirect($retorno)->with('success', 'Evento deletado com sucesso.');
    }

    /**
     * Recupera os convites para eventos e exibe na view
     *
     * @param Convite|null $convite
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function convites(Convite $convite = null)
    {
        //Caso não exista um ID na URL, mostra todos convites do usuário
        if (!$convite) {
            //Recupera os convites ainda não aceitos/recusados
            $convites['pendentes'] = Convite::where('status', null)->where('funcionario_id', Auth::id())->whereHas('evento', function (Builder $query) {
                $query->whereHas('agenda', function (Builder $query) {
                    $query->where('deleted_at', '=', null);
                });
            })->get();
            //Recupera os convites já aceitos
            $convites['definidos'] = Convite::where('status', '<>', null)->where('funcionario_id', Auth::id())->whereHas('evento', function (Builder $query) {
                $query->whereHas('agenda', function (Builder $query) {
                    $query->where('deleted_at', '=', null);
                });
            })->get();
        } else {
            if (!Auth::user()->is($convite->funcionario))
                //Verifica se o usuário tentando ver o convite é o convidado
                abort(403, 'Acesso negado.');

            //Caso tenha um ID na URL, existe apenas um convite
            $convites['definidos'] = new Collection();
            $convites['pendentes'] = new Collection();
            if ($convite->status)
                $convites['definidos']->add($convite);
            else
                $convites['pendentes']->add($convite);
        }
        //Retorna para a view eventos.convites e exibe o/os convites
        return view('calendario::eventos.convites', ['convites' => $convites]);
    }

    /**
     * Aceita um convite
     *
     * @param Convite $convite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function aceitarConvite(Convite $convite)
    {
        //Verifica se o usuário tentando aceitar o convite é o convidado
        if ($convite)
            if (!Auth::user()->is($convite->funcionario->user))
                abort(403, 'Acesso negado.');

        //Seta o campos status para true (aceito)
        $convite->status = true;
        $convite->save();

        //Retorna para a view convites.index
        return redirect()->route('convites.index')->with('success', 'Convite aceito com sucesso.');
    }

    /**
     * Deleta um convite
     *
     * @param Convite $convite
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deletarConvite(Convite $convite)
    {
        //Verifica se o usuário tentando deletar o convite é o convidado
        if ($convite)
            if (!Auth::user()->is($convite->funcionario->user))
                abort(403, 'Acesso negado.');

        $convite->delete();
        //Retorna pra view convites.index
        return redirect()->route('convites.index')->with('success', 'Convite deletado com sucesso.');
    }

    /**
     * Remove o aceite à um convite
     *
     * @param Convite $convite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revogarConvite(Convite $convite)
    {
        //Verifica se o usuário tentando revogar o convite é o convidado
        if ($convite)
            if (!Auth::user()->is($convite->funcionario->user))
                abort(403, 'Acesso negado.');

        //Seta o campos status novamente para null (como um novo convite)
        $convite->status = null;
        $convite->save();

        //Retorna para a view convites.index
        return redirect()->route('convites.index')->with('success', 'Convite revogado com sucesso.');
    }

    /**
     * Método auxiliar para formatar a data (varia se for evento dia-todo)
     *
     * @param $data
     * @return Carbon
     */
    public static function formatar_data($data)
    {
        $formatos = ['d/m/Y H:i', 'd/m/Y'];
        foreach ($formatos as $formato) {
            try {
                $data_formatada = Carbon::createFromFormat($formato, $data);
                break;
            } catch (\Exception $e) {
                unset($e);
            }
        }
        return $data_formatada;
    }
}
