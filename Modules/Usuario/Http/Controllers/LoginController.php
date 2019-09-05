<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {   
        return view('usuario::index');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('apelido', 'password');

        if (Auth::guard()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/usuario')->with('success','Login efetuado com sucesso!');
            // return Usuario::firstOrFail()->where('apelido', $value)
            // $results = DB::select('select * from cliente where id = ?', [1]);
        }else{
            // return back()->withErrors(['apelido' => ['Usuário inválido ou inexistente'],'senha' => ['Senha incorreta']]);
            return back()->with('error', 'Falha no login!');
        }
    }
    public function logoutUsuario(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/')->with('info','Logout efetuado com sucesso!');
    }

}