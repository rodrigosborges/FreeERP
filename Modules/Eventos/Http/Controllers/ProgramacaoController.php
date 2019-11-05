<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Programacao;
use Modules\Eventos\Entities\Palestrante;

class ProgramacaoController extends Controller
{
    public function exibir($id){
        $evento = Evento::find($id);
        $atividades = DB::table('programacao')->where('evento_id', $id)->get();
        return view('eventos::programacao', ['evento' => $evento, 'atividades' => $atividades]);
    }
    
    function cadastrar(Request $request){
        try{
            $palestrante = new Palestrante();
            $palestrante->nome = $request->nomePalestrante;
            $palestrante->bio = $request->bio;

            if ($request->hasFile('fotoPalestrante')){
                $arquivo = $request->fotoPalestrante;
                $tamanho = getimagesize($arquivo);
                if($tamanho[0] == $tamanho[1]) {
                    $extensao = $arquivo->getClientOriginalExtension();
                    $nomeArquivo = time() . '.' . $extensao;
                    $upload = $request->fotoPalestrante->storeAs('palestrantes', $nomeArquivo);
                    $palestrante->foto = $nomeArquivo;
                }
            } else {
                $palestrante->foto = '';
            }

            $palestrante->save();

            $programacao = new Programacao();
            $programacao->nome = $request->nome;
            $programacao->tipo = $request->tipo;
            $programacao->descricao = $request->descricao;
            $programacao->data = $request->data;
            $programacao->horario = $request->horario;
            $programacao->duracao = $request->duracao;
            $programacao->local = $request->local;
            $programacao->vagas = $request->vagas;
            $programacao->evento_id = $request->eventoId;
            $programacao->palestrante_id = $palestrante->id;
            $programacao->save();
        } catch (\Exception $e) {
            return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
                ->with('error', 'Falha ao adicionar ' . $request->nome . ': ' . $e->getMessage);
        }
        return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
            ->with('success', $request->nome . ' adicionado(a) com sucesso.');
    }
    
    function editar (Request $request){
        
        try{
            $programacao = Programacao::find($request->id);
            $programacao->update(['nome' => $request-> nome, 'tipo' => $request->tipo, 'descricao' => $request->descricao,
                'data' => $request->data, 'horario' => $request->horario, 'duracao' => $request->duracao,
                'local' => $request->local, 'vagas' => $request->vagas]);

            $palestrante = Palestrante::find($programacao->palestrante_id);
            $palestrante->update(['nome' => $request-> nome, 'bio' => $request->bio]);

            if ($request->hasFile('fotoPalestrante')){
                $arquivo = $request->fotoPalestrante;
                if($tamanho[0] == $tamanho[1]) {
                    $extensao = $arquivo->getClientOriginalExtension();
                    $nomeArquivo = time() . '.' . $extensao;
                    $upload = $request->fotoPalestrante->storeAs('palestrantes', $nomeArquivo);
                    $palestrante->update(['foto' => $nomeArquivo]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
                ->with('error', 'Falha ao alterar ' . $request->nome . ': ' . $e->getMessage);
        }
        
        return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
            ->with('success', $request->nome . ' alterado(a) com sucesso.');
    }
    
    public function excluir(Request $request)
    {
        try{
            $programacao = Programacao::find($request->id);
            $palestrante_id = $programacao->palestrante_id;
            $palestrante = Palestrante::find($palestrante_id);
            $palestrante->delete();
            $programacao->delete();
        } catch (\Exception $e) {
            return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
                ->with('error', 'Falha ao excluir ' . $programacao->nome . ': ' . $e->getMessage());
        }
        return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
            ->with('success', $programacao->nome . ' excluído(a) com sucesso.');
    }

    public function getAtividade($idAtividade){
        $atividade = DB::table('programacao')
            ->where('programacao.id', '=', $idAtividade)
            ->join('palestrante', 'palestrante.id', '=', 'programacao.palestrante_id')
            ->select('programacao.*', 'palestrante.nome as nomePalestrante', 'bio', 'foto')
            ->get()
            ->toArray();
        
        return $atividade;
    }
}
