<?php

namespace Modules\Usuario\Http\Controllers\auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Modules\Usuario\Entities\{Usuario,Papel};
use Modules\Usuario\Emails\PasswordReset;
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

    public function recuperarSenha(Request $request){
        $user = Usuario::whereEmail($request->email)->first();
        
        if($user == null){
            return redirect()->back()->with(['error'=> 'Email not exists']);
        }

        $token = uniqid();

        $user->remember_token=$token;
        $user->save();

        Mail::to($request->email)->locale('pt-br')->send(
            new PasswordReset($token)
        );



    //     $user = Usuario::findById($user->id);
    //     $reminder = Reminder::exists($user) ? : Reminder::create($user);
    //     $this->sendEmail($user, $reminder->code);

    //     return $user;

        return redirect()->back()->with(['success'=>'Reset code enviado para o seu email. ']);
    } 


    public function resetarSenha(Request $request){
        $user = Usuario::where($request->token)->first();
        
        if($user == null){
            return redirect()->back()->with(['error'=> 'Token does not exists']);
        }
        $token = $request->token;
        return view('usuario::usuario.trocarSenha',compact('token'));
    
    }

    public function trocarSenhaUpdate(TrocarSenhaRequest $request , $id){
        $usuario = Usuario::where('remember_token',$request->token);
        $usuario->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect('/');
    }

    // public function sendEmail($user, $code){
    //     Mail::send(
    //         'email.activation',
    //         ['user'=>$user, 'code'=>$code],
    //         function($message) use ($user){
    //             $message->to($user->email);
    //             $message->subject("Olá $user->apelido","");
    //         }
    //     );
    // }
}
