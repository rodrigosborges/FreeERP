<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel, PagamentoAssistenciaModel};
use DB;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index(){ //GET da pagina de vizualizações de pagamentos

        return view('assistencia::paginas.pagamentos.localizarPagamentos');
    }
    public function table(Request $req, $status){ //Table para requisição do js na pagina de localização de pagamentos
        $pagamentos = PagamentoAssistenciaModel::where('status', $status);

        if($req->inicio)
            $pagamentos = $pagamentos->where('updated_at', '>=', $req->inicio);

        if($req->fim)
            $pagamentos = $pagamentos->where('updated_at', '<=', $req->fim);

        $pagamentos = $pagamentos->paginate(10);

        return view('assistencia::paginas.pagamentos.table', compact('pagamentos'));

    }

     public function recibo($id){ //GET vizualização do recibo do pagamento
        $pagamento =  PagamentoAssistenciaModel::find($id);
        if($pagamento->status == 'Pago'){
            return view('assistencia::paginas.pagamentos.recibo', compact('pagamento'));
        } else {
            return view('assistencia::paginas.pagamento')->with('error', 'Pagamento do serviço não realizado');
        }
     }


    public function salvar(Request $req, $id) { //Finalização do pagamento
        DB::beginTransaction();
        try {
            $dados = $req->all();
            $forma = '';
            if($dados['forma']==1){
                $forma = 'Dinheiro';
            } else if ($dados['forma']==2) {
                $forma = 'Cartão';
            }

            $pagamento =  PagamentoAssistenciaModel::find($id);
            $pagamento->status = 'Pago';
            $pagamento->forma = $forma;
            $pagamento->delete();
            $pagamento->save();
            
            $conserto = ConsertoAssistenciaModel::findOrFail($id)->delete();
            

            DB::commit();
            if ($dados['recibo']=='N') {
                return redirect()->route('consertos.localizar');
            } else if ($dados['recibo']=='S') {
                return redirect()->route('pagamento.recibo', $pagamento->id);
            }
       
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

    }
    public function imprimir($id) { //Imprimir/PDF do recibo
        $pagamento =  PagamentoAssistenciaModel::find($id);

        return \PDF::loadView('assistencia::paginas.pagamentos._recibo', compact('pagamento'))->stream();
                  
      }

    
}
