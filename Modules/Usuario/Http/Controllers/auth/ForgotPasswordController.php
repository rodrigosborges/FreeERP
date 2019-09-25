<?php

namespace Modules\Usuario\Http\Controllers\auth;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


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
        $user = User::whereEmail($request->email)->first();
        
        if(count($user) == 0){
            return redirect()->back()->with(['error'=> 'Email not exists']);
        }

        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user) ? : Reminder::create($user);
        $this->sendEmail($user, $reminder->code);

        return redirect()->back()->with(['success'=>'Reset code enviado para o seu email. ']);
    }

    public function sendEmail($user, $code){
        Mail::send(
            'email.activation',
            ['user'=>$user, 'code'=>$code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("Olá $user->apelido","");
            }
        );
    }
}
