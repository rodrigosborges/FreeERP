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

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/usuario');
        }
    }
}