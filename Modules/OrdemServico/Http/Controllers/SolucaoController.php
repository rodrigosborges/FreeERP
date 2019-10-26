<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{OrdemServico,Solucao};

class SolucaoController extends Controller
{
    public function store(Request $request,$id)
    {
        $problema_id = OrdemServico::all()->where('protocolo',$id)->first()->problema_id; 
        $solucao = Solucao::firstOrCreate(['descricao' => $request->solucao['descricao'], 'problema_id' => $problema_id ]);
        return redirect()->back()->with('success', 'Solução registrada');
    }

}
