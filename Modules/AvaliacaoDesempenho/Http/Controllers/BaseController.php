<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Entities\Categoria;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Entities\Questao;
use Modules\AvaliacaoDesempenho\Entities\Setor;

class BaseController extends Controller
{
    public function search(Request $request)
    {
        $table = $request->input('table');
        $param = $request->input('parameter');

        switch ($table) {
            case 'avaliacao':
                $result = Avaliacao::where('nome', 'LIKE', '%' . $param . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $param . '%');
                break;
            
            case 'avaliado':
                $result = Avaliado::where('nome', 'LIKE', '%' . $param . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $param . '%');
                break;

            case 'categoria':
                $result = Categoria::where('nome', 'LIKE', '%' . $param . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $param . '%');
                break;

            case 'funcionario':
                $result = Funcionario::where('nome', 'LIKE', '%' . $param . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $param . '%');
                break;

            case 'processo':
                $result = Processo::where('nome', 'LIKE', '%' . $param . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $param . '%');
                break;

            case 'questao':
                $result = Questao::where('enunciado', 'LIKE', '%' . $param . '%')->with('categoria');
                break;

            case 'setor':
                $result = Setor::where('nome', 'LIKE', '%' . $param . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $param . '%');
                break;
            
            default:
                break;
        }

        return $result->get();
    }
}
