<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Entities\Setor;

class AvaliadoController extends Controller
{
 
    public function index() {
        return view('avaliacaodesempenho::avaliados/index');
    }

    public function responder(Request $request) {
        $input = $request->input('avaliado');

        foreach ($input as $key => $value) {
            if (empty($value)) {
                return back()->with('error', 'Todos os campos são obrigatorios.');
            }
        }

        $avaliado = Avaliado::where('token', $input['token'])->first();
        
        if (empty($avaliado)) {
            return back()->with('error', 'Funcionario não encontrado.');
        }
        
        $funcionario = $avaliado->avaliado;

        $avaliacao = Avaliacao::findOrFail($avaliado->avaliacao->id);

        if (empty($avaliacao)) {
            return back()->with('error', 'Avaliação não encontrada.');
        }

        $questoes = $avaliacao->questoes;

        // SE A PROVA EH PARA NAO GESTORES
        if ($avaliacao->gestor == 0) {

            return view('avaliacaodesempenho::avaliados/avaliacao-nao-gestores', compact('avaliacao', 'questoes', 'funcionario'));
        
        //SE A PROVA EH PARA GESTORES
        } else if ($avaliacao->gestor == 1) {
            $setor = Setor::where('gestor_id', $funcionario->id)->first();
            $funcionarios = Funcionario::where('setor_id', $setor->id)->where('id', '<>', $funcionario->id)->get();

            return view('avaliacaodesempenho::avaliados/avaliacao-gestores', compact('avaliacao', 'questoes', 'funcionario', 'setor', 'funcionarios'));
        }

    }
}
