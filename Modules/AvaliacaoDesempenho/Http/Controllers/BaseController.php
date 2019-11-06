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
    public function search(Request $request) {
        $table = $request->input('table');
        $terms = $request->input('term');
        $status = $request->input('status');
        
        switch ($table) {
            case 'avaliacoes':
        
                if (empty($terms) && empty($status)) {        
                    $result = Avaliacao::withTrashed();
        
                } else {
        
                    if ($status == '1') {
                        $result = Avaliacao::where('deleted_at', null);
                    } else if ($status == '0') {
                        $result = Avaliacao::onlyTrashed();
                    } else {
                        $result = Avaliacao::withTrashed();
                    }
        
                    foreach ($terms as $key => $term) {
                        $result = $result->where($key, 'LIKE', '%' . $term . '%');
                    }
                }
                break;

            case 'categorias':

                if (empty($terms) && empty($status)) {
                    $result = Categoria::withTrashed();
        
                } else {
        
                    if ($status == '1') {
                        $result = Categoria::where('deleted_at', null);
                    } else if ($status == '0') {
                        $result = Categoria::onlyTrashed();
                    } else {
                        $result = Categoria::withTrashed();
                    }
        
                    foreach ($terms as $key => $term) {
                        $result = $result->where($key, 'LIKE', '%' . $term . '%');
                    }
                }
                break;

            case 'processos':
                if (empty($terms) && empty($status)) {
                    $result = Processo::withTrashed();
        
                } else {
        
                    if ($status == '1') {
                        $result = Processo::where('deleted_at', null);
                    } else if ($status == '0') {
                        $result = Processo::onlyTrashed();
                    } else {
                        $result = Processo::withTrashed();
                    }
        
                    foreach ($terms as $key => $term) {
                        $result = $result->where($key, 'LIKE', '%' . $term . '%');
                    }
        
                }
                break;

            case 'questoes':
                if (empty($terms) && empty($status)) {

                    $result = Questao::all();
        
                } else {
        
                    if ($status == '0') {
                        $result = Questao::onlyTrashed();
                    } else {
                        $result = Questao::where('deleted_at', null);
                    } 
        
                    foreach ($terms as $key => $term) {
                        $result = $result->where($key, 'LIKE', '%' . $term . '%');
                    }
                    
                    $result = $result->get();
                }
                
                return view('avaliacaodesempenho::questoes/_listar', compact('result'));
                break;

            case 'setores':
                if (empty($terms) && empty($status)) {
                    $result = Setor::withTrashed();
        
                } else {
        
                    if ($status == '1') {
                        $result = Setor::where('deleted_at', null);
                    } else if ($status == '0') {
                        $result = Setor::onlyTrashed();
                    } else {
                        $result = Setor::withTrashed();
                    }
        
                    foreach ($terms as $key => $term) {
                        $result = $result->where($key, 'LIKE', '%' . $term . '%');
                    }
                }
                break;
            
            default:
                break;
        }

        $result = $result->get();
                
        return view('avaliacaodesempenho::'.$table.'._table', compact('result'));
    }

    public function search_field(Request $request)
    {
        $table = $request->input('table');
        $param = $request->input('parameter');

        if (!empty($request->input('id'))) {
            $id = $request->input('id');
        }

        switch ($table) {
            case 'avaliacao':
                $result = Avaliacao::where('nome', 'LIKE', '%' . $param . '%');
                break;
            
            case 'avaliado':
                $result = Avaliado::where('nome', 'LIKE', '%' . $param . '%');
                break;

            case 'categoria':
                $result = Categoria::where('nome', 'LIKE', '%' . $param . '%');
                break;

            case 'funcionario':
                $result = Funcionario::where('nome', 'LIKE', '%' . $param . '%');
                break;

            case 'processo':
                $result = Processo::where('nome', 'LIKE', '%' . $param . '%');
                break;

            case 'questao':
                if (isset($id)) {
                    $result = Questao::where('id', $id)->with('categoria');
                } else {
                    $result = Questao::where('enunciado', 'LIKE', '%' . $param . '%')->with('categoria');
                }
                break;

            case 'setor':
                $result = Setor::where('nome', 'LIKE', '%' . $param . '%');
                break;
            
            default:
                break;
        }

        return $result->get();
    }
}
