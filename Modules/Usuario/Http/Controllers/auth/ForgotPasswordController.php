<?php

namespace Modules\Usuario\Http\Controllers\auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Modules\Usuario\Entities\{Usuario,Papel};
use Modules\Usuario\Emails\PasswordReset;
use Modules\Usuario\Http\Requests\TrocarSenhaRequest;
use Illuminate\Support\Facades\Hash;
use DB;
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

        $token = sha1($user->password);

        $user->reset_password_token=$token;
        $user->save();

        // Mail::to($request->email)->locale('pt-br')->send(
        //     new PasswordReset($token)
        // );



    //     $user = Usuario::findById($user->id);
    //     $reminder = Reminder::exists($user) ? : Reminder::create($user);
    //     $this->sendEmail($user, $reminder->code);

    //     return $user;
        return "<a href='http://localhost:8000/recuperarSenha?token=".$token."'>Resetar senha</a>";
        return redirect()->back()->with(['success'=>'Reset code enviado para o seu email. ']);
    } 


    public function resetarSenha(Request $request){
        // return 'funfou';
        
        $token = $request->token;
        return view('usuario::recover',compact('token'));
    
    }

    public function trocarSenhaUpdate(TrocarSenhaRequest $request){


        $usuario = Usuario::where('reset_password_token',$request->token); 
        $null = null;

        if(!$usuario->first()){
            return redirect()->back()->with(['error'=> 'Token does not exists']);
        }

        DB::beginTransaction();
        try {
            $usuario->update([
                'password' => Hash::make($request->password),
            ]);

            $usuario = Usuario::findOrFail($usuario->first()->id);

            $usuario->reset_password_token = null;
            $usuario->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return redirect()->back()->with(['error'=> 'Erro no servidor']);
        }

        
        return redirect('/')->with(['success'=>'Senha atualizada com sucesso, acesse agora a sua conta. ']);
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
