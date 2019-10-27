<?php

namespace Modules\Protocolos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Protocolos\Entities\{TipoProtocolo, TipoAcesso, Protocolo, Usuario, Tramite, Documento};
use Modules\Protocolos\Http\Requests\{CreateProtocolo};
use Illuminate\Support\Facades\Auth;
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

        $id = Auth::user()->id;
        
        $protocolos = new Protocolo;
        
        //Retorna os protocolos que o usuário foi cadastrado como interessado.
        // $protocolos = DB::table('protocolo')->join('protocolo_has_usuario', 'protocolo_has_usuario.protocolo_id', 'protocolo.id')
        //         ->where('protocolo_has_usuario.usuario_id','=', $id);
        //Retorna os protocolos que o usuário criou.
        //$protocolos = DB::table('protocolo')->where('usuario_id', '=', $id); Retorna os protocolos criados pelo usuário logado.

		if($request['pesquisa']) {
            $protocolos = $protocolos->where('assunto', 'like', '%'.$request['pesquisa'].'%');
        }
        if($status == "ativos"){
            $protocolos = $protocolos->join('protocolo_has_usuario', 'protocolo_has_usuario.protocolo_id', 'protocolo.id')->where('protocolo_has_usuario.usuario_id','=', $id);
        }
        if($status == "meus-protocolos"){
            $protocolos = $protocolos->where('usuario_id', '=', $id);
        }
		if($status == "inativos"){
            $protocolos = $protocolos->onlyTrashed();
        }
            
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
            'interessados'      => [new Usuario],
            'tipo_protocolo'    => TipoProtocolo::all(),
            'tipo_acesso'       => TipoAcesso::all(),
            'usuario'           => Usuario::all(),
            'title'             => 'Cadastro de Protocolo',
            'button'            => 'Salvar',
        ];
        return view('protocolos::protocolo.form', compact('data'));
    }

    public function fetch(Request $request){

        $query = $request->get('query'); 
        $data = DB::table('usuario')->where('nome', 'LIKE', '%'.$query.'%')->get();
        $content = [];
        foreach($data as $dados){
            $content[] = [
                'label' => $dados->nome,
                'value' => $dados->id
            ];  
        }
        return $content;
    }

    public function fetchApensado(Request $request){
       
        $query = $request->get('query'); 
        $data = DB::table('protocolo')->where('assunto', 'LIKE', '%'.$query.'%')->get();
        $content = [];
        foreach($data as $dados){
            $content[] = [
                'label' => $dados->assunto,
                'value' => $dados->id
            ];  
        }
        return $content;

    }

    public function salvarApensado(Request $request){

        try{

            DB::beginTransaction();

            $protocolo = Protocolo::findOrFail($request->id);
    
            $protocolo->apensados()->attach($request->apensado);

            DB::commit();
            
            return response()->json(['protocolo' => $protocolo, 'status' => 'success'], 200);

        }

        catch(Exception $e){

            DB::rollback();
            
            return $e;
            
		}
    }

    public function store(Request $request){


        $interessados = explode(',', $request['interessados']);

        $interessadosArray = [];

        foreach($interessados as $interessado) {
            $interessadosArray[] = [
                'usuario_id' => $interessado
            ];
        }
        

        DB::beginTransaction();

		try{

			$protocolo = Protocolo::Create([
                'assunto'               => $request['assunto'],
                'tipo_protocolo_id'     => $request->protocolo['tipo_protocolo_id'],
                'tipo_acesso_id'        => $request->protocolo['tipo_acesso_id'],
                'usuario_id'            => Auth::user()->id,
            ]);
            

            $protocolo->interessado()->attach($interessadosArray);
           

            DB::commit();
            
            return redirect('protocolos/protocolos')->with('success', 'Protocolo cadastrado com sucesso!');
            
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
        
    }

    public function encaminhar(Request $request, $id){

        $idLogado = Auth::user()->id;
        
        $data = [
           'url'        => url("protocolos/protocolos/$id"),
           'model'      => '',
           'usuario'    => Usuario::where('id','<>',$idLogado)->whereNotIn('id',function($query) use($id){
                                        $query->select('usuario_id')->from('protocolo_has_usuario')->where('protocolo_id','=', $id);
                                    })->get(),
           'button'     => 'Encaminhar'
        ];

        // dd($data);
        
        return view('protocolos::protocolo.encaminhar', compact('data'));
    }

    public function salvarEncaminhamento(Request $request, $id){


        $protocolo = Protocolo::where('id', '=',$id)->first();
       

        DB::beginTransaction();

		try{

			$tramite = Tramite::Create([
                'observacao'            => $request['observacao'],
                'status'                => 'Pendente',
                'origem'                => Auth::user()->id,
                'destino'               => $request->tramite['destino'],
                'protocolo_id'          => $id
            ]);

            $protocolo->interessado()->attach(['protocolo_id' => $id]);

            DB::commit();
            
            return redirect('protocolos/protocolos')->with('success', 'Encaminhamento feito com sucesso!');
            
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }

    public function acompanhar($id){
        
        

        $data = ([
            'model'         => '',
            'url'           => url("protocolos/acompanhar/$id"),
            'protocolo'     => Protocolo::findOrFail($id),
            'tramite'       => Tramite::where('protocolo_id', '=', $id)->get(),
            'documento'     => Documento::where('protocolo_id', '=', $id)->get(),
            'title'         => 'Acompanhamento de Protocolo',
            'button'        => 'Adicionar',
        ]);
        
        return view('protocolos::protocolo.acompanhar', compact('data'));
    }


    public function teste(Request $request){
        return response()->json('Alo', 200);
    }

    public function salvarDocumento(Request $request){

        if($request->hasFile('documento') && $request->file('documento')->isValid() && $request->documento->extension() == 'pdf'){
            $nome = md5(date('Y-m-d H:i:s'));
            $extensao = $request->documento->extension();
            $nameFile = "{$nome}.{$extensao}";
            $documento = $nameFile;
            $upload = $request->documento->storeAs('documentos', $nameFile);
            if(!$upload){
                return redirect()
                            ->back()
                            ->with('error', 'Falha no upload do arquivo');
            }
        }

        DB::beginTransaction();

        try{

            $documento = Documento::Create([
                'nome_documento'    => $request->file('documento')->getClientOriginalName(),
                'documento'         => $documento,
                'protocolo_id'      => $request['id-protocolo']
            ]);
 
            
            DB::commit();

            return response()->json($documento);

        }catch(Exception $e){

			DB::rollback();
            return back();
            
		}
    }

   public function download(Request $request){

        return 'lalala';

   }
    
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
        $protocolo = Protocolo::withTrashed()->findOrFail($id);
        if($protocolo->trashed()) {
            $protocolo->restore();
            return back()->with('success', 'Protocolo ativado com sucesso!');
        } else {
            $protocolo->delete();
            return back()->with('success', 'Protocolo desativado com sucesso!');
        }
    }
}
