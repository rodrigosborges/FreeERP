<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Usuario\Entities\Usuario;
use Modules\Usuario\Http\Requests\{UsuarioStoreRequest,UsuarioUpdateRequest};
use Illuminate\Support\Facades\Hash;
use DB;

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
                 'usuarios' => Usuario::paginate(5)
             ];
         }
        $usuariosInativos = Usuario::onlyTrashed()->get();
        return view('usuario::usuario.index', compact('data', 'usuariosInativos'));
    }

    public function create()
    {
        return view('usuario::usuario.form');
    }

    public function store(UsuarioStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $usuario = Usuario::create([
                'apelido' => $request->apelido,
                'avatar' => $request->avatar,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            DB::commit();
    
            return back()->with('success', 'Usuário cadastrado com sucesso');
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

        return view('usuario::usuario.form', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        if($request->password){
            $usuario->update([
                'password' => Hash::make($request->password)
                ]);
        }
        else{
            $usuario->update($request->all());
        }
        return redirect('/usuario');
    }

    public function destroy($id)
    {
       $usuario = Usuario::findOrFail($id);
       $usuario->delete();
       return back();
    }

    public function restore($id){
        $usuario = Usuario::onlyTrashed()->findOrFail($id);
        $usuario->restore();
        return back();
    }

    public function trocarSenha($id){
        $usuario = Usuario::findOrFail($id);
        return view('usuario::usuario.trocarSenha',compact('usuario'));
    }
}
