<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{
    OrdemServico
};
use DB;

class AcompanhamentoController extends Controller
{
    public function acompanharOS(){
        return view('ordemservico::ordemservico.acompanhamento.form');
    }

    public function linhaTempo(Request $request){
        $data = [
            'model' => OrdemServico::all()->where('protocolo',$request->protocolo)->first(),
        ];
        if($data['model'] == null ){
            return redirect()->back()->with('error','Protocolo não encontrado');
        }
        return view('ordemservico::ordemservico.acompanhamento.linhaTempo',compact('data'));
    }
}