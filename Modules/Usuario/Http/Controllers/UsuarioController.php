<?php

namespace Modules\Usuario\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Usuario\Entities\{Usuario,Papel,Modulo};
use Modules\Usuario\Http\Requests\{UsuarioStoreRequest,UsuarioUpdateRequest,TrocarSenhaRequest};
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
  
    public function index(Request $request){
            if ($request->has('busca')) {
                $busca = $request->get('busca');
                $data = [
                    'title' => 'Usuario',
                    'usuarios' => Usuario::where('id', 'like', "%{$busca}%")
                    ->orWhere('apelido', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%")
                    ->paginate(5)
                ];
                $data['usuarios']->appends(['busca' => $busca]);
                return view('usuario::usuario.index', compact('data', 'busca'));
            } else {
                $data = [
                    'title' => 'Usuário',
                    'usuarios' => Usuario::paginate(10)
                ];
            }
            $usuariosInativos = Usuario::onlyTrashed()->get();
            return view('usuario::usuario.index', compact('data', 'usuariosInativos'));
    }

    public function create()
    {
        // if (Gate::allows('administrador',Auth::user())|| Gate::allows('operador',Auth::user())) {
            $papeis = Papel::all();
            $modulos = Modulo::all();
            return view('usuario::usuario.form',compact('papeis','modulos'));
        // }         
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');
    
    }

    public function store(UsuarioStoreRequest $request)
    {   
        // if (Gate::allows('administrador',Auth::user()) || Gate::allows('operador',Auth::user())  ) {
            DB::beginTransaction();
            try{
                $avatar = $request->file('avatar');
                $nameFile = "default.png";

                if($avatar && $avatar->isValid()){
                    $name = uniqid(date('HisYmd'));
                    $extension = $request->avatar->extension();

                    $nameFile = "{$name}.{$extension}";

                    $upload = $request->avatar->storeAs('img/avatars',$nameFile);

                    if(!$upload){
                        return redirect()->back()->with('error','Falha ao fazer upload de avatar')->withInput();
                    }
                }
                
                $usuario = Usuario::create([
                    'apelido' => $request->apelido,
                    'email' => $request->email,
                    'papel_id' => $request->papel,
                    'avatar' => $nameFile,
                    'password' => Hash::make($request->password)
                ]);
        
                $usuario->modulos()->attach($request['modulo']);
                DB::commit();
        
                return back()->with('success', 'Usuário cadastrado com sucesso');
            }catch(\Exception $e){
                DB::rollback();
                dd($e);
                return back()->with('error', 'Erro no servidor');
        }
    // }
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');

    }

    public function show($id)
    {
        return view('usuario::usuario.show');
        
    }

    public function edit($id)
    {
        //if (Gate::allows('administrador',Auth::user()) || Gate::allows('operador',Auth::user())  ) {
            $usuario = Usuario::findOrFail($id);
            $papeis = Papel::all();
            $modulos = Modulo::all();

            return view('usuario::usuario.form', compact('usuario','papeis','modulos'));
        //}
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');
    }

    public function update(UsuarioUpdateRequest $request, $id)
    {
        
        //if (Gate::allows('administrador',Auth::user()) || Gate::allows('operador',Auth::user())  ) {

            DB::beginTransaction();
            try{
                //atualizando dados básicos
                $usuario = Usuario::findOrFail($id);

                // $usuario->modulos()->delete();
                // DB::commit();

                $usuario->update([
                    'apelido' => $request->apelido,
                    'email' => $request->email,
                ]);

                $usuario->modulos()->detach();
                
                $usuario->modulos()->attach($request['modulo']);

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
                dd($e);
                return back()->with('error', 'Erro no servidor');
            }

            return redirect('/usuario');
        //}
            
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');
    }

    public function destroy($id)
    {
        //if (Gate::allows('administrador',Auth::user())) {
            if(Auth::user()->id == $id){
                return redirect()->back()->with("error","Impossível deletar sua conta logada");
            }
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return back();
        //}            
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');
    }

    public function restore($id){    
        //if (Gate::allows('administrador',Auth::user())) {       
            $usuario = Usuario::onlyTrashed()->findOrFail($id);
            $usuario->restore();
            return back();
        //}
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');
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
        //if (Gate::allows('administrador',Auth::user() ) && ($usuario->papel->nome != "Administrador" || $usuario == Auth::user())) {    
            return view('usuario::usuario.trocarSenha',compact('usuario'));
        //}
        return redirect()->back()->with('error','Você não possui permissão para acessar a pagina!');
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
