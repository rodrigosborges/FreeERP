<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Entities\{Endereco,Estado,Cidade, Email, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Mensagem};
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mail;

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
            ['icon' => 'assignment', 'tool' => 'Vagas', 'route' => '/recrutamento/vaga'],
            ['icon' => 'assignment', 'tool' => 'Vagas Disponíveis', 'route' => '/recrutamento/vagasDisponiveis'],
            ['icon' => 'assignment', 'tool' => 'Categorias', 'route' => '/recrutamento/categoria'],
            ['icon' => 'assignment', 'tool' => 'Cargos', 'route' => '/recrutamento/cargo'],
            ['icon' => 'assignment', 'tool' => 'Etapas', 'route' => '/recrutamento/etapa'],
            ['icon' => 'group', 'tool' => 'Candidatos', 'route' => '/recrutamento/candidato'],
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
        $candidato = Candidato::findOrFail($request->candidato_id);
        $email= $candidato->email()->first()->email;
        $mensagem = Mensagem::Create($request->all());
        if($mensagem){
            Mail::send('recrutamento::email.mensagem',['mensagem' => $mensagem], function ($m) use ($candidato){
                $m->from('comprateste06@gmail.com', 'RH Empresa');
                $m->to($candidato->email()->first()->email, $candidato->nome)->subject('RH Empresa');
            });
        }else{
            return redirect()->back()->with('error', 'Erro ao Marcar Entrevista');
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

}
