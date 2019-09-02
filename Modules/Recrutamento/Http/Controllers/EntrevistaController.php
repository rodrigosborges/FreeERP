<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Entities\{Endereco,Estado,Cidade, Email, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Entrevista};
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EntrevistaController extends Controller
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
            ['icon' => 'assignment', 'tool' => 'Vaga', 'route' => '/recrutamento/vaga'],
            ['icon' => 'assignment', 'tool' => 'Vagas Disponíveis', 'route' => '/recrutamento/vagasDisponiveis'],
            ['icon' => 'assignment', 'tool' => 'Entrevista', 'route' => '/recrutamento/entrevista'],
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
        $email= $candidato->email()->get()[0]['email'];
        $entrevista = Entrevista::Create($request->all());
        if($entrevista){
            // emails para quem será enviado o formulário
            $emailenviar = $request->email;
            $destino = $email;
            $assunto = "Entrevista Marcada";
            
            // É necessário indicar que o formato do e-mail é html
            $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: Empresa <$request->email>';
            //$headers .= "Bcc: $EmailPadrao\r\n";
            
            $enviaremail = mail($destino, $assunto, $request->mensagem, $headers);
            if($enviaremail){
            
                return "boa";
            
            } else {
                return "deu ruim"; 
            }
        }
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

    public function marcarEntrevista($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'candidato'	=> Candidato::findOrFail($id),
            'url'       => url("recrutamento/entrevista/"),
            'button'    => 'Marcar Entrevista',
            "model"		=> null,
		]; 
        return view('recrutamento::entrevista.formulario', compact('data','moduleInfo','menu'));
    }

}
