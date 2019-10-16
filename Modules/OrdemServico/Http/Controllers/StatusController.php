<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{
    Status
};
use DB;

class StatusController extends Controller
{
    public function create()
    {
        $data = [
            'title' => 'Cadastrar Status',
            'url' => 'ordemservico/status/store',
            'button' => 'Salvar'
        ];
        return view('ordemservico::ordemservico.status.form',compact('data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Status::create($request->all());
            DB::commit();
            return redirect()->back()->with('success', 'Status cadastrado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }
}
