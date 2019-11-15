<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Estado;
use Modules\Eventos\Entities\Permissao;
use Modules\Eventos\Entities\Programacao;
use Modules\Eventos\Entities\Pessoa;
use Modules\Eventos\Entities\Nivel;
use Modules\Eventos\Entities\Certificado;
use Modules\Eventos\Http\Requests\SalvaEvento;
use Carbon\Carbon;


class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
       
    //EXIBE AS VIEWS
    public function index(){
        $data = new Carbon();
        $data->format('Y-m-d');
        $eventos = Evento::orderBy('dataInicio', 'ASC')->where('dataFim', '>=', $data)->get();
        $estados = Estado::all();
        return view('eventos::index', ['eventos' => $eventos,'estados' => $estados]);
    }
    
    public function exibir()
    {        
        $eventos = Evento::whereHas('permissoes', function (Builder $query){
            $query->where('pessoa_id', '=', auth::id());
        })->get();
        $estados = Estado::all();
        $pessoas = Pessoa::all();
        $usuario = Auth::user()->id;
        return view('eventos::eventos', ['eventos' => $eventos,'estados' => $estados, 'pessoas' => $pessoas, 'usuario' => $usuario]);
    }
    
    public function cadastrar(SalvaEvento $request)
    {
        try{
            $evento = new Evento();
            $evento->nome = $request->nome;
            $evento->local = $request->local;
            $evento->cidade_id = $request->cidade;
            $evento->dataInicio = $request->dataInicio;
            $evento->dataFim = $request->dataFim;
            $evento->descricao = $request->descricao;
            $evento->empresa = $request->empresa;
            $evento->email = $request->email;
            $evento->telefone = $request->telefone;

            if ($request->hasFile('imgEvento')){
                $arquivo = $request->imgEvento;
                $extensao = $arquivo->getClientOriginalExtension();
                $nomeArquivo = time() . '.' . $extensao;
                $upload = $request->imgEvento->storeAs('eventos', $nomeArquivo);
                $evento->imagem = $nomeArquivo;
            } else {
                $evento->imagem = '';
            }
            
            $evento->save(); 
            
            $permissao = new Permissao();
            $permissao->evento()->associate($evento);
            $permissao->nivel()->associate(Nivel::find(2));
            $permissao->pessoa()->associate(Auth::user());
            
            $permissao->save();
            
            $organizadores = $request->organizador;
            if($organizadores != null){
                foreach ($organizadores as $pessoa_id){
                    $permissao = new Permissao();
                    $permissao->evento()->associate($evento);
                    $permissao->nivel()->associate(Nivel::find(1));
                    $permissao->pessoa()->associate($pessoa_id);
                    $permissao->save();
                }
            }            
        } catch (\Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao adicionar evento: ' . $e->getMessage());
        }
        return redirect()->route('eventos.exibir')
                ->with('success', $request->nome . ' adicionado(a) com sucesso.');
        
    }
    
    public function editar(SalvaEvento $request)
    {
        try{
            $evento = Evento::find($request->id);
            $evento->update(['nome' => $request->nome,'local' => $request->local,'dataInicio' => $request->dataInicio, 'dataFim' => $request->dataFim, 'descricao' => $request->descricao, 'empresa' => $request->empresa, 'email' => $request->email, 'telefone' => $request->telefone]);
            $evento->cidade_id = $request->cidade;
            $evento->save();
            
            if ($request->hasFile('imgEvento')){
                $arquivo = $request->imgEvento;
                $extensao = $arquivo->getClientOriginalExtension();
                $nomeArquivo = time() . '.' . $extensao;
                $upload = $request->imgEvento->storeAs('eventos', $nomeArquivo);
                $evento->update(['imagem' => $nomeArquivo]);
            }
            
            $excluiPermissao = Permissao::where('evento_id', $request->id)->where('nivel_id', 1)->delete();
            
            $organizadores = $request->organizador;
            
            if($organizadores != null){
                foreach ($organizadores as $pessoa_id){
                    $permissao = new Permissao();
                    $permissao->evento()->associate($evento);
                    $permissao->nivel()->associate(Nivel::find(1));
                    $permissao->pessoa()->associate($pessoa_id);
                    $permissao->save();
                }
            }
            
        } catch (\Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao atualizar evento ' . $request->nome . ': ' . $e->getMessage());
        }
        return redirect()->route('eventos.exibir')
            ->with('success', $request->nome . ' alterado(a) com sucesso.');
    }
    
    public function excluir(Request $request)
    {
        try{
            $evento = Evento::find($request->id);
            $evento->pessoas()->detach();
            $evento->delete();
        } catch (\Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao excluir ' . $evento->nome . ': ' . $e->getMessage());
        }
        
        return redirect()->route('eventos.exibir')
            ->with('success', $evento->nome . ' excluído(a) com sucesso.');
    }
    
    public function detalhar($id){
        $evento = Evento::find($id);
        $programacao = $evento->programacao;
        return view('eventos::detalhaEvento', ['evento' => $evento, 'programacao' => $programacao]); 
    }
    
    //INSCRIÇÃO EM ATIVIDADE
    public function inscricao(Programacao $programacao)
    {    
        if ($programacao->participantes()->where('pessoa_id', Auth::id())->first()) {
            $programacao->participantes()->detach(Auth::id());
        } else {
            $programacao->participantes()->attach(Auth::id());
        }

        return redirect()->route('eventos.detalhar', ['evento' => $programacao->evento]);
    }
    
    //RETORNA UM EVENTO, INCLUSIVE COM NOME DA CIDADE E DO ESTADO E UF DO ESTADO
    public function getEvento($id){
        $evento = DB::table('evento')
                ->where('evento.id', '=', $id)
                ->join('cidade', 'evento.cidade_id', '=', 'cidade.id')
                ->join('estado', 'cidade.estado_id', '=', 'estado.id')
                ->select('evento.id','nome','local','dataInicio','dataFim','descricao','imagem','empresa','email','telefone','cidade_id','nomeCidade','estado_id','nomeEstado','uf')
                ->get();
        return $evento;
    }
    
    //RETORNA TODOS OS ORGANIZADORES DE UM EVENTO
    public function getOrganizador($id){
        $organizadores = DB::table('evento_has_pessoa')
                ->where('evento_id', '=', $id)
                ->where('nivel_id', '=', 1)
                ->get();
        return $organizadores;
    }
    
    //RETORNA A DATA ATUAL
    public function getData(){
        $data = new Carbon();
        return $data->format('Y-m-d');
    }
    
    public function certificados(Evento $evento){
        $pessoas = new Collection();
        
        foreach($evento->programacao as $atividade){
            foreach($atividade->participantes as $participante){
                $faltou = DB::table('evento_has_participante')
                    ->where('programacao_id', $atividade->id)
                    ->where('pessoa_id', $participante->id)
                    ->first('faltou');
                if ($faltou->faltou != 1){
                    $pessoas->add($participante);
                }
            }
        }
        
        $pessoas = $pessoas->unique();
        
        foreach($pessoas as $participante){
            if($participante->faltou != 1){
                $this->gerarCertificado($evento->id, $participante);
            }
        }
        
        return redirect()->route('pessoas.exibir', ['evento' => $evento->id])
            ->with('success', 'Certificados emitidos com sucesso.');
    }
    
    public function gerarCertificado($id, $participante){
        $evento = Evento::find($id);
        $pessoa = $participante;
        $atividades = $pessoa->atividades;
        $cargaHoraria = Carbon::createFromFormat('H:i', '00:00');
        foreach ($atividades as $atividade){
            if($atividade->evento_id == $evento->id){
                $duracao = explode(":", $atividade->duracao);
                $cargaHoraria->addHour($duracao[0]);
                $cargaHoraria->addMinutes($duracao[1]);
                $participou[] = $atividade;
            }
        }
        $data = new Carbon();
        $data = $data->formatLocalized('%d de %B de %Y');
        $nomeArquivo = "storage/certificado/" . time() . $pessoa->id . ".pdf";
        $pdf = \PDF::loadView('eventos::certificado',['evento' => $evento, 'pessoa' => $pessoa, 'cargaHoraria' => $cargaHoraria, 'data' => $data, 'participou' => $participou])
                ->setPaper('a4', 'landscape')
                ->save($nomeArquivo);
        $certificado = new Certificado();
        $certificado->evento()->associate($evento);
        $certificado->pessoa()->associate($pessoa);
        $certificado->certificado = $nomeArquivo;

        $certificado->save();
    }
}
