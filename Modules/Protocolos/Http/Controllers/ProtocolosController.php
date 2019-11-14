<?php

namespace Modules\Protocolos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Protocolos\Entities\{TipoProtocolo, TipoAcesso, Protocolo, Usuario, Tramite, Status, Documento, Log};
use Modules\Protocolos\Http\Requests\{ProtocoloStoreRequest, DocumentoStoreRequest};
use Illuminate\Support\Facades\Auth;
use DB;
use Khill\Lavacharts\Lavacharts;

class ProtocolosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        $dataAtualMenosUmAno = date('Y-m-d', strtotime('-1 years'));

        $data = [
            'protocolos'    => Protocolo::all(),
            'title'         => 'Lista de Protocolos',
            'finalizado'    => Protocolo::onlyTrashed()->count(),
            'andamento'     => Protocolo::where('status_id', '<>', '6')->where('updated_at', '>', $dataAtualMenosUmAno)->count(),
            'encalhado'     => Protocolo::where('updated_at', '<', $dataAtualMenosUmAno)->count(),
            'total'         => Protocolo::withTrashed()->count(),
        ];

        return view('protocolos::protocolo.index', compact('data'));
    }

    public function chart(){
        return view('protocolos::protocolo.chart');
    }


    public function list(Request $request, $status){

        $id = Auth::user()->id;
        
        $protocolos = new Protocolo;

        $log = new Log;

		if($request['pesquisa']) {
            $protocolos = $protocolos->where('assunto', 'like', '%'.$request['pesquisa'].'%');
        }
        if($status == "caixa-entrada"){

            $protocolosIds = [];
           
            foreach(Protocolo::all() as $protocolo) {

                $ultimoUsuarioQueModificou = $protocolo->user_modificador_id;
                $interessados = $protocolo->interessado()->pluck('usuario_id')->toArray();
                
                if($protocolo->status_id == 1 && $protocolo->usuario_id !== Auth::user()->id) {
                    
                    if($protocolo->tipo_acesso != 1) {
                        $protocolosIds[] = $protocolo->id;

                    }
                    else if($protocolo->tipo_acesso == 1 && in_array(Auth::user()->id, $interessados)) {
                        $protocolosIds[] = $protocolo->id;
                    }

                }
                else if($protocolo->status_id == 2 && $ultimoUsuarioQueModificou != Auth::user()->id) {
                    
                    if($protocolo->tipo_acesso != 1) {
                        $protocolosIds[] = $protocolo->id;
                    }
                    else if($protocolo->tipo_acesso == 1 && (in_array(Auth::user()->id, $interessados) || $protocolo->usuario_id == Auth::user()->id)) {
                        $protocolosIds[] = $protocolo->id;
                    }
                    
                }
            }
            
            $protocolos = $protocolos->whereIn('id', $protocolosIds);   
            
        }
        if($status == "despacho"){

            $protocolosIds = [];

            foreach(Protocolo::all() as $protocolo) {
                $ultimoUsuarioQueModificou = $protocolo->logs->last()->usuario_id;
                $usuarioQueModificou = Usuario::findOrFail($ultimoUsuarioQueModificou);
                $usuarioLogado = Usuario::findOrFail(Auth::user()->id);

                if($protocolo->status_id == 3){
                    if($ultimoUsuarioQueModificou == Auth::user()->id || $usuarioQueModificou->setor->id == $usuarioLogado->setor->id){
                        $protocolosIds[] = $protocolo->id;
                    }
                } 
            }
            
            $protocolos = $protocolos->whereIn('id', $protocolosIds);
        }

        if($status == "caixa-saida"){
            
            $protocolosIds = [];

            foreach(Protocolo::all() as $protocolo){

                $ultimoUsuarioQueModificou = $protocolo->user_modificador_id;
                $usuarioQueModificou = Usuario::findOrFail($ultimoUsuarioQueModificou);
                $usuarioLogado = Usuario::findOrFail(Auth::user()->id);

                if($protocolo->status_id != 3){
                    if($ultimoUsuarioQueModificou == Auth::user()->id){
                        $protocolosIds[] = $protocolo->id;
                    }
                } 
            }
             
            $protocolos = $protocolos->whereIn('id', $protocolosIds);
           
        }

		if($status == "inativos"){
            $protocolos = $protocolos->onlyTrashed();
        }
            
        $protocolos = $protocolos->paginate(10);
        
        
		return view('protocolos::protocolo.table', compact('protocolos','status'));
	}

    public function receber($id){

        $protocolo = Protocolo::findOrFail($id);

        $protocolo->status_id = '3';
        $protocolo->user_modificador_id = Auth::user()->id;
        $protocolo->save();

        try{

            DB::beginTransaction();

            $log = Log::Create([
                'status_id'        => '3',
                'usuario_id'    => Auth::user()->id,
                'protocolo_id'  => $protocolo->id
            ]);
            
            DB::commit();
            
            return back()->with('success', 'O protocolo agora aguarda seu despacho.');
            
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
        

        
        // $produto->save();

        // $compra->produto()->update([
        //     'nome' => 'batata'
        // ]);
    }
    public function create(Request $request)
    {
        $data = [
            'url'               => url("protocolos/protocolos"),
            'model'             => '',
            'interessados'      => [new Usuario],
            'tipo_protocolo'    => TipoProtocolo::all(),
            'usuario'           => Usuario::all(),
            'title'             => 'Cadastro de Protocolo',
            'button'            => 'Salvar',
        ];
        return view('protocolos::protocolo.form', compact('data'));
    }

    public function store(ProtocoloStoreRequest $request){


        $interessados = explode(',', $request['interessados']);

        $interessadosArray = [];

        foreach($interessados as $interessado) {
            $interessadosArray[] = [
                'usuario_id' => $interessado
            ];
        }
        
        if(Protocolo::select()->get()->last() == ''){
            $lastId = 1;
        }else{
            
            $lastId= (Protocolo::select('id')->get()->last()->id)+1;
        }

        DB::beginTransaction();

		try{

			$protocolo = Protocolo::Create([
                'numero'                => $lastId."-".date("Y"),
                'assunto'               => $request['assunto'],
                'tipo_protocolo_id'     => $request->protocolo['tipo_protocolo_id'],
                'tipo_acesso'           => $request->protocolo['tipo_acesso'],
                'status_id'             => '1',
                'user_modificador_id'   => Auth::user()->id,
                'usuario_id'            => Auth::user()->id,
            ]);
            

            $protocolo->interessado()->attach($interessadosArray);

            $log = Log::Create([
                'status_id'        => '1',
                'usuario_id'    => $protocolo->usuario_id,
                'protocolo_id'  => $protocolo->id,
            ]);
           
            DB::commit();
            
            return redirect('protocolos/protocolos')->with('success', 'Protocolo cadastrado com sucesso!');
            
		}catch(\Exception $e){
			DB::rollback();
			return back();
		}
        
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

    public function teste($id){
        $query = '1-';
        $protocolo = Protocolo::findOrFail($id);
        // $apenssados = $protocolo->apensados->first()->pivot->protocolo_id;

        foreach ($protocolo->apensados()->get() as $key => $apensado) {
            $array[$key] =  $apensado->pivot->apensado_id;
        }

        //return $array;

        if(!isset($array)){
            $data = Protocolo::where('numero', 'LIKE', '%'.$query.'%')->where('id', '!=', $id)->get();
        }else{
            $data = Protocolo::where('numero', 'LIKE', '%'.$query.'%')->whereNotIn('id',$array)->where('id', '!=', $id)->get();
        }

        
        $content = [];
        foreach($data as $dados){
            $content[] = [
                'label' => $dados->numero,
                'value' => $dados->id
            ];  
        }
        return $content;
    }

    public function fetchApensado(Request $request){
        
        $id = $request->id_protocolo;
        $protocolo = Protocolo::findOrFail($id);
        // $apenssados = $protocolo->apensados->first()->pivot->protocolo_id;
        $query = $request->get('query');
        foreach ($protocolo->apensados()->get() as $key => $apensado) {
            $array[$key] =  $apensado->pivot->apensado_id;
        }

        //return $array;

        if(!isset($array)){
            $data = Protocolo::where('numero', 'LIKE', '%'.$query.'%')->where('id', '!=', $id)->get();
        }else{
            $data = Protocolo::where('numero', 'LIKE', '%'.$query.'%')->whereNotIn('id',$array)->where('id', '!=', $id)->get();
        }

        
        $content = [];
        foreach($data as $dados){
            $content[] = [
                'label' => $dados->numero,
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

            $log = Log::Create([
                'status_id'        => '5',
                'usuario_id'    => Auth::user()->id,
                'protocolo_id'  => $protocolo->id
            ]);

            DB::commit();
            
            return response()->json(['protocolo' => $protocolo, 'status' => 'success'], 200);
        }

        catch(Exception $e){

            DB::rollback();
            
            return $e;
            
		}
    }

    public function encaminhar(Request $request, $id){
        
        $protocolo = Protocolo::findOrFail($id);
        $idLogado = Auth::user()->id;
        
            $data = [
            'url'        => url("protocolos/protocolos/$id"),
            'model'      => '',
            'usuario'    => Usuario::where('id','<>',$idLogado)->whereNotIn('id',function($query) use($id){
                                            $query->select('usuario_id')->from('protocolo_has_usuario')->where('protocolo_id','=', $id);
                                        })->get(),
            'button'     => 'Despachar'
            ];

        $ultimoUsuarioQueModificou = $protocolo->user_modificador_id;
        $interessados = $protocolo->interessado()->pluck('usuario_id')->toArray();

        if($protocolo->tipo_acesso == 1 && $ultimoUsuarioQueModificou == Auth::user()->id || (in_array(Auth::user()->id, $interessados))){
            return view('protocolos::protocolo.encaminhar', compact('data'));
        }
        else if($protocolo->tipo_acesso == 0){
            return view('protocolos::protocolo.encaminhar', compact('data'));
        }
        else{
            return back()->with('error', 'Esse protocolo é privado!');
        }
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

            $protocolo->interessado()->attach(['usuario_id' => $request->tramite['destino']]);
            
            $protocolo->status_id = '2';
            $protocolo->user_modificador_id = Auth::user()->id;
            $protocolo->save();

            $log = Log::Create([
                'status_id'        => '5',
                'usuario_id'    => Auth::user()->id,
                'protocolo_id'  => $protocolo->id
            ]);

            DB::commit();
            
            return redirect('protocolos/protocolos')->with('success', 'Despachado com sucesso!');
            
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }

    public function acompanhar($id){
        
        
        $data = ([
            'model'                 => '',
            'url'                   => url("protocolos/acompanhar/$id"),
            'protocolo'             => Protocolo::findOrFail($id),
            'log'                   => Log::where('protocolo_id', '=', $id)->get(),
            'ultima_modificacao'    => Log::where('protocolo_id', '=', $id)->where('status_id', '<>', '4')->get()->last(),
            'tramite'               => Tramite::where('protocolo_id', '=', $id)->get(),
            'documento'             => Documento::where('protocolo_id', '=', $id)->get(),
            'title'                 => 'Acompanhamento de Protocolo',
            'button'                => 'Adicionar',
        ]);
        

        $log = Log::Create([
            'status_id'        => '4',
            'usuario_id'    => Auth::user()->id,
            'protocolo_id'  => $data['protocolo']->id
        ]);

        if($data["protocolo"]->tipo_acesso == 1) {

            $interessadosIds = $data['protocolo']->interessado()->pluck('usuario_id')->toArray();

            if(in_array(Auth::user()->id, $interessadosIds) || Auth::user()->id == $data['protocolo']->usuario_id) {
                return view('protocolos::protocolo.acompanhar', compact('data'));
            } else{
                return back()->with('error', 'Esse protocolo é privado!');
            }
        }
        else{
            return view('protocolos::protocolo.acompanhar', compact('data'));
        }
        return view('protocolos::protocolo.acompanhar', compact('data'));
    }

    public function salvarDocumento(DocumentoStoreRequest $request){

        if($request->hasFile('documento') && $request->file('documento')->isValid() && $request->documento->extension() == 'pdf' || 'doc' || 'docx' || 'xsl' || 'csv'){
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
            
            $log = Log::Create([
                'status_id'        => '5',
                'usuario_id'    => Auth::user()->id,
                'protocolo_id'  => $request['id-protocolo']
            ]);
            
            DB::commit();

            return response()->json($documento);

        }catch(Exception $e){

			DB::rollback();
            return back();
            
		}
    }

   public function download($id){

        $documento = Documento::findOrFail($id);

        return response()->download(storage_path('app/documentos/' . $documento->documento));

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

            $log = Log::Create([
                'status_id'         => '3',
                'usuario_id'        => Auth::user()->id,
                'protocolo_id'      => $id
            ]);

            return back()->with('success', 'Protocolo ativado com sucesso!');
        } else {

            $protocolo->delete();

            $log = Log::Create([
                'status_id'         => '6',
                'usuario_id'        => Auth::user()->id,
                'protocolo_id'      => $id
            ]);

            return back()->with('success', 'Protocolo desativado com sucesso!');
        }
    }
}
