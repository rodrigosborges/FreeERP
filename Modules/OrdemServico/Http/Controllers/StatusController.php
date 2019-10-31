<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\OrdemServico\Entities\{
    Status,
    OrdemServico,
    Aparelho
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

    public function showStatusOS($id){
        return json_encode(OrdemServico::all()->where('protocolo',$id)->first()->status_id);
    }
    
    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
           $os = OrdemServico::all()->where('protocolo',$id)->first();
           $os->update( $request->all());
           $os->historico()->attach([
               'status_id' => $request->status_id
           ]);
            if($request->status_id == Status::all()->where('titulo','Marcado como Inutilizável')->first()->id){
                Aparelho::findOrFail($os->aparelho->id)->update(['inutilizacao' => true]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Status atualizado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }
}
