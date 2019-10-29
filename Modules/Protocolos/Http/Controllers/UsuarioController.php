<?php

namespace Modules\Protocolos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Protocolos\Entities\{Usuario,Setor};
use Modules\Protocolos\Http\Requests\{UsuarioStoreRequest,UsuarioUpdateRequest,TrocarSenhaRequest};
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
  
    public function index(Request $request){
        
    
    }

    public function create()
    {
        $data = [
            'url'           => url("protocolos/envia"),
            'model'         => '',
            'setor'         => Setor::all(),
            'button'        => 'Salvar',
        ];

        return view('protocolos::usuario.form',compact('data'));
    }

    public function store(UsuarioStoreRequest $request)
    {
        DB::beginTransaction();

        try{
            
            $usuario = Usuario::create([
                'nome'      => $request->nome,
                'apelido'   => $request->apelido,
                'email'     => $request->email,
                'setor_id'  => $request->usuario['setor_id'],
                'password'  => Hash::make($request->password)
            ]);
    
            DB::commit();
    
            return redirect('protocolos/protocolos/login')->with('success', 'Usuário cadastrado com sucesso');

        }catch(\Exception $e){

            DB::rollback();
            return back()->with('error', 'Erro no servidor');

        }
    }
    public function show($id)
    {
        return view('usuario::usuario.show');
    }
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $papeis = Papel::all();
        return view('usuario::usuario.form', compact('usuario','papeis'));
    }
    public function update(UsuarioUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            //atualizando dados básicos
            $usuario = Usuario::findOrFail($id);
            $usuario->update([
                'apelido' => $request->apelido,
                'email' => $request->email,
                'papel_id' => $request->papel
            ]);
            
            //pegando a imagem 
            $avatar = $request->file('avatar');
            if($avatar && $avatar->isValid()){
                $name = uniqid(date('HisYmd'));
                $extension = $request->avatar->extension();
                $nameFile = "{$name}.{$extension}";
                $upload = $request->avatar->storeAs('img/avatars',$nameFile);
            
                if(!$upload){
                    return redirect()->back()->with('error','Falha ao fazer upload de avatar')->withInput();
                }
                //verifica se o nome do avatar não é default para então apagar a foto antiga
                if($usuario->avatar != 'default.png' && $avatar){
                    $dirPath = public_path()."/storage/img/avatars/";
                    File::delete($dirPath.$usuario->avatar);
                }
                $usuario->avatar = $nameFile;
                $usuario->save();
            }
            
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
        return redirect('/usuario');
    }
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->back()->with("error","Impossível deletar sua conta logada");
        }
       $usuario = Usuario::findOrFail($id);
       $usuario->delete();
       return back();
    }
    public function restore($id){
        $usuario = Usuario::onlyTrashed()->findOrFail($id);
        $usuario->restore();
        return back();
    }
    public function trocarSenhaUpdate(TrocarSenhaRequest $request , $id){
        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect('/usuario');
    }
    public function trocarSenha($id){
        $usuario = Usuario::findOrFail($id);
        return view('usuario::usuario.trocarSenha',compact('usuario'));
    }
    public function isUnique(Request $request,$id=null){
        $key = key($request->query());
        
        $field = Usuario::where($key, $request->$key)->first();
     
        if($field && $id != $field->id ){
            return 'false';
        } else {
            return 'true';
        }
    }
}