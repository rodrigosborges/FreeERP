<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Entities\{Endereco,Estado,Cidade, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Mensagem,Email};
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mail;
use Auth;

class MensagemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    protected $moduleInfo;
    protected $menu;
    public function  __construct(){
        $this->moduleInfo = [
            'icon' => 'people',
            'name' => 'RECRUTAMENTO',
        ];
        $this->menu = [
            ['icon' => 'next_week', 'tool' => 'Vagas', 'route' => '/recrutamento/vaga'],
            ['icon' => 'category', 'tool' => 'Categorias', 'route' => '/recrutamento/categoria'],
            ['icon' => 'work', 'tool' => 'Cargos', 'route' => '/recrutamento/cargo'],
            ['icon' => 'assignment', 'tool' => 'Etapas', 'route' => '/recrutamento/etapa'],
            ['icon' => 'group', 'tool' => 'Candidatos', 'route' => '/recrutamento/candidato'],
            ['icon' => 'email', 'tool' => 'Emails', 'route' => '/recrutamento/mensagem/malaDireta'],
            ['icon' => 'card_giftcard', 'tool' => 'Benefícios', 'route' => '/recrutamento/beneficio'],
            ['icon' => 'power_settings_new', 'tool' => 'Logout', 'route' => '/logout'],
		];
    }





    public function index()
    {
        return view('recrutamento::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('recrutamento::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $mail_to = Auth::user()->email;
        $request->email = $mail_to;
        
        $candidato = Candidato::findOrFail($request->candidato_id);
        $email= $candidato->email()->first()->email;
        $mensagem = Mensagem::Create($request->all());
        if($mensagem){

            Mail::send('recrutamento::email.mensagem',['mensagem' => $mensagem], function ($m) use ($mail_to,$candidato,$request){
                $m->from($mail_to);
                $m->to($candidato->email()->first()->email, $candidato->nome)->subject($request->assunto);
            });

            //Avaliador
            
            $apelido = Auth::user()->apelido;
            Mail::send('recrutamento::email.mensagem',['mensagem' => $mensagem], function ($m) use ($mail_to,$request,$apelido){
                $m->from($mail_to);
                $m->to($mail_to,  $apelido)->subject($request->assunto);
            });
        }else{
            return redirect()->back()->with('error', 'Erro ao Enviar Mensagem');
        }
        return redirect('recrutamento/candidato')->with('success', 'Mensagem enviada com sucesso');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('recrutamento::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('recrutamento::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function enviarMensagem($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'candidato'	=> Candidato::findOrFail($id),
            'url'       => url("recrutamento/mensagem/"),
            'button'    => 'Enviar Email',
            "model"		=> null,
		]; 
        return view('recrutamento::mensagem.formulario', compact('data','moduleInfo','menu'));
    }

    public function malaDireta()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'url'       => url("recrutamento/mensagem/enviarEmails"),
            'button'    => 'Enviar Email',
            'model'    => Candidato::all(),
        ]; 
        
       

        return view('recrutamento::mensagem.malaDireta', compact('data','moduleInfo','menu'));
    }

    public function enviarEmails(Request $request)
    {   

        $mail_to = Auth::user()->email;
        $request->mensagem['email'][$mail_to];

        $men = array();
        $men['assunto'] = $request->mensagem['assunto'];
        $men['mensagem'] = $request->mensagem['mensagem'];

     

        foreach($request->candidatos as $idCandidato){

            $men['candidato_id'] = $idCandidato;

            $candidato = Candidato::findOrFail($idCandidato);
            $email= $candidato->email()->first()->email;

            $mensagem = Mensagem::Create($men);

            Mail::send('recrutamento::email.mensagem',['mensagem' => $mensagem], function ($m) use ($mail_to,$candidato,$request){
                $m->from($mail_to);
                $m->to($candidato->email()->first()->email, $candidato->nome)->subject($request->assunto);
            });

            //Avaliador
            // $apelido = Auth::user()->apelido;
            // Mail::send('recrutamento::email.mensagem',['mensagem' => $mensagem], function ($m) use ($mail_to,$request,$apelido){
            //     $m->from($mail_to);
            //     $m->to($mail_to,  $apelido)->subject($request->assunto);
            // });

        
        }

        
       return redirect('recrutamento/candidato')->with('success', 'Mensagem enviada com sucesso');
    }




}
