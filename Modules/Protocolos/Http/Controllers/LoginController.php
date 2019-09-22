<?php

namespace Modules\Protocolos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check()){

            return redirect()->intended('/protocolos/protocolos')->with('warning','Usuário já logado!');

        }

        return view('protocolos::login.index');
    }

    public function authenticate(Request $request){
        
        $credentials = $request->only('apelido', 'password');
        if (Auth::guard()->attempt($credentials)) {
            
            return redirect()->intended('/protocolos/protocolos')->with('success','Login efetuado com sucesso!');
           
        }else{
           
            return back()->with('error', 'Credenciais não conferem!');
        }
    }

    public function logoutUsuario(Request $request)
    {
        Auth::logout();

        return redirect()->intended('/protocolos/protocolos')->with('error','Logout efetuado com sucesso!');
    }
}
    