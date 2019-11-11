<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Aprovacao;
use Modules\Calendario\Entities\Compartilhamento;
use Modules\Calendario\Entities\Funcionario;
use Modules\Calendario\Entities\Setor;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Http\Requests\AgendaSalvarRequest;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Abre a view com a lista de agendas do usuário
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agendas()
    {
        //Recupera o usuário logado
        $funcionario = Funcionario::where('user_id', Auth::id())->first();

        //Recupera as agendas que estão ativas e excluída
        $agendas = Agenda::withTrashed()->where('funcionario_id', $funcionario->id)->orderByRaw('deleted_at DESC, created_at DESC')->get();
        $lixeira = Agenda::onlyTrashed()->where('funcionario_id', $funcionario->id)->count();

        //Retorna para a view agendas.index com as agendas recuperadas
        return view('calendario::agendas.index', ['agendas' => $agendas, 'lixeira' => $lixeira]);
    }

    /**
     * Abre a view para cadastro de uma nova agenda ou edição de uma já existente
     *
     * @param Agenda|null $agenda
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function criarOuEditar(Agenda $agenda = null)
    {
        //Verificar se o usuário que está editando a agenda é o próprio criador
        if ($agenda)
            if (!Auth::user()->is($agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        //Recupera as cores (servirá para colorir os eventos)
        $cores = Cor::all();

        //Recupera os setores (poderá ser usado ao compartilhar uma agenda)
        $setores = Setor::all();

        //Retorna para a view agendas.criar-editar com as variáveis anteriores, e caso seja edição, com a variável $agenda preenchida
        return view('calendario::agendas.criar-editar', ['cores' => $cores, 'agenda' => $agenda, 'setores' => $setores]);
    }

    /**
     * Salva uma nova agenda
     *
     * @param AgendaSalvarRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AgendaSalvarRequest $request)
    {
        try {
            //Recupera o usuário logado
            $funcionario = Funcionario::where('user_id', Auth::id())->first();

            //Cria um objeto para agenda, preenche com os dados recebidos do formulário, faz os vínculos com cor e usuário
            $agenda = new Agenda();
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor()->associate(Cor::find($request->agendaCor));
            $agenda->funcionario()->associate($funcionario);
            $agenda->save();

            //Recupera as solicitações de compartilhamentos da agenda com setores, cria o objeto e faz os vínculos
            if ($request->agendaCompartilhamento) {
                foreach ($request->agendaCompartilhamento as $setor_id) {
                    $compartilhamento = new Compartilhamento();
                    $compartilhamento->setor()->associate(Setor::find($setor_id));
                    $compartilhamento->funcionario()->associate($funcionario);
                    $agenda->compartilhamentos()->save($compartilhamento);
                }
            }

        } catch (QueryException $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao criar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda "' . $request->agendaNome . '" criada com sucesso.');
    }

    /**
     * Atualiza uma agenda já existente
     *
     * @param AgendaSalvarRequest $request
     * @param Agenda $agenda
     * @return \Illuminate\Http\RedirectResponse
     */
    public function atualizar(AgendaSalvarRequest $request, Agenda $agenda)
    {
        //Verificar se o usuário que está editando a agenda é o próprio criador
        if ($agenda)
            if (!Auth::user()->is($agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        try {
            //Atualiza o objeto da agenda já existente com os dados recebidos pelo formulário
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor()->associate(Cor::find($request->agendaCor));
            $agenda->save();

            //Recupera as solicitações de compartilhamentos da agenda com setores
            $compartilhamentos = [];
            if ($request->agendaCompartilhamento) {
                foreach ($request->agendaCompartilhamento as $setor_id) {

                    //Caso seja uma nova solicitação, um objeto é criado e salvo no BD, do contrário, apenas recupera os dados
                    $compartilhamentos[] = Compartilhamento::firstOrCreate([
                        'setor_id' => $setor_id,
                        'agenda_id' => $agenda->id,
                        'funcionario_id' => Funcionario::where('user_id', Auth::id())->first()->id
                    ]);
                }
            }

            //Verifica se existe compartilhamentos já salvos que foram excluídos na edição da agenda, e caso existe o deleta do banco
            foreach ($agenda->compartilhamentos as $agenda_compartilhamento) {
                $achou = false;
                foreach ($compartilhamentos as $compartilhamento) {
                    if ($compartilhamento->is($agenda_compartilhamento))
                        $achou = true;
                }
                if (!$achou)
                    $agenda_compartilhamento->delete();
            }

        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao atualizar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda "' . $request->agendaNome . '" atualizada com sucesso.');
    }

    /**
     * Deleta uma agenda
     *
     * @param Agenda $agenda
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletar(Agenda $agenda)
    {
        //Verificar se o usuário que está deletando a agenda é o próprio criador
        if ($agenda)
            if (!Auth::user()->is($agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        try {
            if ($agenda->trashed())
                $agenda->forceDelete();
            else
                $agenda->delete();
        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao deletar agenda. Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda deletada com sucesso.');
    }

    /**
     * Remove da lixeira uma agenda deletada
     *
     * @param Agenda $agenda
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restaurar(Agenda $agenda)
    {
        //Verificar se o usuário que está restaurando a agenda é o próprio criador
        if ($agenda)
            if (!Auth::user()->is($agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        try {
            //Remove da lixeira
            $agenda->restore();
        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao restaurar agenda. Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda restaurada com sucesso.');
    }

    /**
     * Abre a view com as solicitações de compartilhamentos de agendas com setores
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compartilhamentos()
    {
        //Recupera os compartilhamentos com os setores que o usuário é chefia
        $compartilhamentos = Compartilhamento::whereHas('setor', function (Builder $query) {
            $query->where('user_id', '=', Auth::id());
        })->get();
        $solicitacoes['pendentes'] = [];
        $solicitacoes['aprovadas'] = [];

        //Separa os compartilhamentos em aprovados e pendentes
        foreach ($compartilhamentos as $compartilhamento) {
            if (!$compartilhamento->aprovacao) {
                array_push($solicitacoes['pendentes'], $compartilhamento);
            } else {
                array_push($solicitacoes['aprovadas'], $compartilhamento);
            }
        }

        //Retorna para a view agendas.compartilhamentos com os compartilhamentos
        return view('calendario::agendas.compartilhamentos', ['solicitacoes' => $solicitacoes]);
    }

    /**
     * Aprova a solicitação de compartilhamento da agenda
     *
     * @param Compartilhamento $compartilhamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function aprovarCompartilhamento(Compartilhamento $compartilhamento)
    {
        //Verifica se o usuário que está aprovando é chefia naquele setor
        if ($compartilhamento)
            if (!Auth::id() == $compartilhamento->setor->user_id)
                abort(403, 'Acesso negado.');

        //Cria o objeto da aprovação e vincula com o usuário logado (aprovador)
        $aprovacao = new Aprovacao();
        $aprovacao->funcionario()->associate(Funcionario::where('user_id', Auth::id())->first());
        $compartilhamento->aprovacao()->save($aprovacao);

        //Retorna para a view anterior
        return redirect()->back()->with('success', 'Compartilhamento aprovado com sucesso.');
    }

    /**
     * Nega a solicitação de compartilhamento da agenda
     *
     * @param Compartilhamento $compartilhamento
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function negarCompartilhamento(Compartilhamento $compartilhamento)
    {
        //Verifica se o usuário que está negando é chefia naquele setor
        if ($compartilhamento)
            if (!Auth::id() == $compartilhamento->setor->user_id)
                abort(403, 'Acesso negado.');

        //Apaga o compartilhamento sem criar aprovação
        $compartilhamento->delete();

        //Retorna para a view anterior
        return redirect()->back()->with('success', 'Compartilhamento negado com sucesso.');
    }

    /**
     * Revoga a aprovação de compartilhamento
     *
     * @param Compartilhamento $compartilhamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revogarAprovacao(Compartilhamento $compartilhamento)
    {
        //Verifica se o usuário que está negando é chefia naquele setor
        if ($compartilhamento)
            if (!Auth::id() == $compartilhamento->setor->user_id)
                abort(403, 'Acesso negado.');

        //Excluí a aprovação do compartilhamento, retornando para um status de nova solicitação
        $compartilhamento->aprovacao()->delete();

        //Retorna para a view anterior
        return redirect()->back()->with('success', 'Compartilhamento revogado com sucesso.');
    }

    /**
     * Exibe todos os eventos de uma determinada agenda
     *
     * @param Agenda $agenda
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function eventos(Agenda $agenda)
    {
        //Verificar se o usuário que está verificando a agenda é o próprio criador
        if ($agenda)
            if (!Auth::user()->is($agenda->funcionario->user))
                abort(403, 'Acesso negado.');

        //Exibe os eventos caso a agenda não esteja vazia, do contrário, é exibido a listagem de agendas
        if (!$agenda->eventos->isEmpty())
            $retorno = view('calendario::eventos.index', ['eventos' => $agenda->eventos, 'agenda' => $agenda]);
        else
            $retorno = redirect()->route('agendas.index');

        return $retorno;
    }
}
