<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    Aparelho
};
use DB;

class AparelhoController extends Controller
{

    public function index(Request $request)
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $aparelho = Aparelho::create($request->aparelho());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function show($id)
    {
        $data = [
            'url' => url("ordemservico/aparelho/$id"),
            'model' =>  Aparelho::findOrFail($id),
            'title' => 'Descrição',
        ];
        return view('ordemservico::aparelho.show', compact('data'));
    }

    public function showAjax(Request $request){
        $dados = Aparelho::findOrFail($request->id);

        return response()->json($dados);
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

   
}

