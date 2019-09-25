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
        if(Auth::check()){
            return redirect()->intended('/usuario')->with('warning','Usuário já logado!');
        }
        return view('usuario::index');
        

    }
    
    public function authenticate(Request $request)
    {
        
        if(strrpos($request['login'], "@")){
            $login = 'email';
            // Auth::attempt(['email' => $request->login , 'password' => $request->password]);
            
        }else{
            $login = 'apelido';
        }

        $credentials = [$login => $request->login , 'password' => $request->password];
        

       // $credentials = $request->only('apelido', 'password');

        if (Auth::guard()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/usuario')->with('success','Login efetuado com sucesso!');
            // return Usuario::firstOrFail()->where('apelido', $value)
            // $results = DB::select('select * from cliente where id = ?', [1]);
        }else{
            // return back()->withErrors(['login' => ['Usuário inválido ou inexistente'],'password' => ['Senha incorreta']]);
            // return back()->with('error', 'Credenciais não conferem!');
        }
    }
    public function logoutUsuario(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/')->with('info','Logout efetuado com sucesso!');
    }

}