<?php

namespace Modules\Estoque\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Estoque\Entities\TipoUnidade;
use Modules\Estoque\Http\Requests\TipoUnidadeRequest;

class TipoUnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tipos = TipoUnidade::all();
        return view('estoque::tipoUnidade.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $data = [
            'titulo' => 'Cadastrar Tipo de Unidade',
            'button' => 'Cadastrar',
            'url' => 'estoque/tipo-unidade',
            'tipo' => null,
        ];

        return view('estoque::tipoUnidade.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TipoUnidadeRequest $request)
    {

        DB::beginTransaction();
        try {
            TipoUnidade::create($request->all());
            DB::commit();
            return redirect("/estoque/tipo-unidade")->with('success', "Unidade " . $request->nome . " cadastrado com sucesso!");
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('danger', "Erro ao cadastrar unidade! cod: " + $e->getMessage());
        }
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return $this->inativos();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $tipo = TipoUnidade::findOrFail($id);
        $data = [
            'button' => 'atualizar',
            'url' => 'estoque/tipo-unidade/' . $id,
            'tipo' => TipoUnidade::findOrFail($id),
            'titulo' => 'Editar Unidade',
        ];
        return view('estoque::tipoUnidade.form', compact('data', 'tipo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(TipoUnidadeRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $tipo = TipoUnidade::findOrFail($id);
            $tipo->update($request->all());
            DB::commit();
            return redirect("/estoque/tipo-unidade")->with('success', "Unidade " . $request->nome . " atualizado com sucesso!");
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('danger', "Erro ao atualizar unidade! cód: " . $e->getMessage());
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $tipo = TipoUnidade::findOrFail($id);

        $tipo->delete();
        return back()->with('success', 'Unidade Removida com sucesso');
    }
    public function restore($id)
    {
        $tipo = TipoUnidade::onlyTrashed()->findOrFail($id);
        $tipo->restore();
        return back()->with('success', 'categoria ' . $tipo->nome . " restaurada com sucesso");
    }
    public function inativos()
    {
        $inativos = TipoUnidade::onlyTrashed()->get();

        return view('estoque::tipoUnidade.inativos', compact('inativos'));
    }
}
