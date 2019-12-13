<?php
namespace Modules\Funcionario\Http\Controllers;

use DB;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;use Illuminate\Routing\Controller;

use Modules\Funcionario\Entities\Cargo;

use Modules\Funcionario\Entities\Funcionario;

use Modules\Funcionario\Http\Requests\CreateCargo;

class CargoController extends Controller
{

    public function index(Request $request)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                'cargos' => Cargo::all(),
                'title' => "Lista de cargos",
            ];

            return view('funcionario::cargo.index', compact('data'));
        }
    }

    function list(Request $request, $status) {
        if (Gate::allows('administrador', Auth::user())) {
            $cargos = new Cargo;

            if ($request['pesquisa']) {
                $cargos = $cargos->where('nome', 'like', '%' . $request['pesquisa'] . '%');
            }

            if ($status == "inativos") {
                $cargos = $cargos->onlyTrashed();
            }

            $cargos = $cargos->paginate(10);
            return view('funcionario::cargo.table', compact('cargos', 'status'));
        }
    }

    public function create(Request $request)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                "url" => url('funcionario/cargo'),
                "button" => "Salvar",
                "model" => null,
                'title' => "Cadastrar cargo",
            ];

            return view('funcionario::cargo.form', compact('data'));
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('administrador', Auth::user())) {
            DB::beginTransaction();
            $input = $request->nome;

            $verificarRegistro = DB::table('cargo')->where('nome', $input)->orWhere(function ($query) {
                $query->where('deleted_at', '!=', null)->where('deleted_at', '=', null);
            })->get();

            if ($verificarRegistro->isNotEmpty()) {
                return redirect('funcionario/cargo')->with('error', 'Cargo já existente');

            } else {

                try {
                    $cargo = Cargo::Create($request->all());
                    DB::commit();
                    return redirect('funcionario/cargo')->with('success', 'Cargo cadastrado com sucesso!');
                } catch (Exception $e) {
                    DB::rollback();
                    return back();
                }
            }
        }
    }

    public function edit(Request $request, $id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                "url" => url("funcionario/cargo/$id"),
                "button" => "Atualizar",
                "model" => Cargo::findOrFail($id),
                'title' => "Atualizar cargo",
            ];

            return view('funcionario::cargo.form', compact('data'));
        }
    }

    public function update(CreateCargo $request, $id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            DB::beginTransaction();
            try {
                $cargo = Cargo::findOrFail($id);
                $cargo->update($request->all());
                DB::commit();
                return redirect('funcionario/cargo')->with('success', 'Cargo atualizado com sucesso!');
            } catch (Exception $e) {
                DB::rollback();
                return back();
            }
        }
    }

    public function show(Request $request, $id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $cargo = Cargo::findOrFail($id);
            return view('funcionario::cargo.show', [
                'model' => $cargo,
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $cargo = Cargo::withTrashed()->find($id);
            if ($cargo->trashed()) {
                $cargo->restore();
                return back()->with('success', 'Cargo ativado com sucesso!');
            } else {
                $cargo->delete();
                return back()->with('success', 'Cargo desativado com sucesso!');
            }
        }
    }

    public function search($valor)
    {

        $cargos = DB::table('cargo')->select('id', 'nome')->where('nome', 'like', '%' . $valor . '%')->where('cargo.deleted_at', null)->limit(10)->get();

        return $cargos;

    }

}
