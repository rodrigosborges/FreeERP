<?php

namespace Modules\Usuario\Http\Controllers\auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Sentinel;
use Reminder;
use Modules\Usuario\Entities\Usuario;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function esqueceu(){
        return view('usuario::forgot');
    }

    public function senha(Request $request){
        $user = Usuario::whereEmail($request->email)->first();
        
        if($user==null){
            return redirect()->back()->with(['error'=> 'Email não cadastrado']);
        }
        return $user;
        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user) ? : Reminder::create($user);
        $this->enviarEmail($user, $reminder->code);

        return redirect()->back()->with(['success'=>'Reset code enviado para o seu email. ']);
    }

    public function enviarEmail($user, $code){
        Mail::send(
            'email.forgot',
            ['user'=>$user, 'code'=>$code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("Olá $user->apelido",", resete sua senha");
            }
        );
    }
}
