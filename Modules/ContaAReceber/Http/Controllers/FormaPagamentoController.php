<?php

namespace Modules\ContaAReceber\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContaAReceber\Entities\FormaPagamentoModel;

class FormaPagamentoController extends Controller
{
     public function index(){
        $formapgs = FormaPagamentoModel::where('ativo', 1)->get();
        return view('contaareceber::formapagamento', compact('formapgs'));
    }

    public function salvar(Request $request)
    {
        $dados = $request->all();
        FormaPagamentoModel::create($dados);
        $formapgs = FormaPagamentoModel::where('ativo', 1)->get();
        return view('contaareceber::formapagamento', compact('formapgs'))->with('success','A categoria foi cadastrado com sucesso!');
    }   
    
    public function deletar($id){
        $formapg = FormaPagamentoModel::find($id);
        $formapg->ativo = false;
        $formapg->update();
        return $this->index();
    }     
}