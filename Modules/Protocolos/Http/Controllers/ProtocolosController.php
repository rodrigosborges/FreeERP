<?php

namespace Modules\Protocolos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Protocolos\Entities\{TipoProtocolo, TipoAcesso, Interessado, Protocolo, Setor};
use Modules\Protocolos\Http\Requests\{CreateProtocolo};
use DB;

class ProtocolosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = [
            'protocolos' => Protocolo::all(),
            'title' => 'Lista de Protocolos',
        ];

        return view('protocolos::protocolo.index', compact('data'));
    }

    public function list(Request $request, $status){
		$protocolos = new Protocolo;
		if($request['pesquisa']) {
            $protocolos = $protocolos->where('assunto', 'like', '%'.$request['pesquisa'].'%');
        }
		if($status == "inativos")
			$protocolos = $protocolos->onlyTrashed();
		$protocolos = $protocolos->paginate(10);
		return view('protocolos::protocolo.table', compact('protocolos','status'));
	}

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $data = [
            'url'               => url("protocolos/protocolos"),
            'model'             => '',
            'interessados'      => [new Interessado],
            'tipo_protocolo'    => TipoProtocolo::all(),
            'tipo_acesso'       => TipoAcesso::all(),
            'interessado'       => Interessado::all(),
            'setor'             => Setor::all(),
            'title'             => 'Cadastro de Protocolo',
            'button'            => 'Salvar',
        ];
        return view('protocolos::protocolo.form', compact('data'));
    }

    public function fetch(Request $request){

        $query = $request->get('query'); 
        $data = DB::table('interessado')->where('nome', 'LIKE', '%'.$query.'%')
            ->pluck('nome');

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){

        

        DB::beginTransaction();

		try{

			$protocolo = Protocolo::Create([
                'assunto'               => $request['assunto'],
                'tipo_protocolo_id'     => $request->protocolo['tipo_protocolo_id'],
                'tipo_acesso_id'        => $request->protocolo['tipo_acesso_id'],
                'setor_id'              => $request->protocolo['setor_id']
            ]);
            
            foreach($request->interessados as $interessado){

                $interessado = Interessado::create($interessado);

                $protocolo->interessado()->attach([

                    'interessado_id' => $interessado->id

                ]);
            }

            DB::commit();
            
            return redirect('protocolos/protocolos')->with('success', 'Protocolo cadastrado com sucesso!');
            
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
   

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('protocolos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
