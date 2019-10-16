<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Routing\Controller;

use Modules\OrdemServico\Entities\{
    Cidade
};

class CidadeController extends Controller
{
    public function showJson($idEstado){
        $dados = Cidade::all()->where('estado_id',$idEstado);
        return response()->json($dados);
    }

}
