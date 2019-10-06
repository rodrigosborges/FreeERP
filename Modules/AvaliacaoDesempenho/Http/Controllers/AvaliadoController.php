<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;

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

        $avaliacao = Avaliacao::findOrFail($avaliado->avaliacao->id);

        if (empty($avaliacao)) {
            return back()->with('error', 'Avaliação não encontrada.');
        }

        return view('avaliacaodesempenho::avaliados/avaliacao', compact('avaliacao'));
    }
}
