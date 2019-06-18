<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Modules\controleUsuario\Entities\Papel;
use Modules\controleUsuario\Entities\Usuario;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class PapelController extends Controller
{
    protected $dadosTemplate;

    /*MÉTODO CONTRUTOR*/
    public function __construct()
    {

        /* Inicializa com o icone e nome padrao */

        // $papel = Papel::find()->where('idUsuario', '=', $idUsuario);
        $papel = 'administrador';
        $menu = [];

        switch ($papel) {
            case 'administrador':
            $menu = [
                ['icon' => 'vpn_key', 'tool' => 'Login', 'route' => '/controleusuario/autenticar'],
                ['icon' => 'people', 'tool' => 'Usuarios', 'route' => '/controleusuario/cadastrar'],
                ['icon' => 'event_note', 'tool' => 'Papéis', 'route' => '/controleusuario/papel'],
                 ['icon' => 'list_alt', 'tool' => 'Relatórios', 'route' => '/controleusuario/consulta'],
                ['icon' => 'toggle_off', 'tool' => 'Sair', 'route' => '/controleusuario/sair'],
            ];
                break;
            default:
                $menu = [];
        }

        $this->dadosTemplate = [
            'moduleInfo' => [
                'icon' => 'person',
                'name' => 'Controle de Usuario'
            ],
            'menu' => $menu,
        ];
    }

    //FIM MÉTODO CONTRUTOR
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $papeis = Papel::withTrashed()->get();

        return view('controleusuario::papel.index', $this->dadosTemplate, compact('papeis',));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('controleusuario::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //

        $papel = new Papel;
        $papel->nome = $request->nome;
        $papel->descricao = $request->descricao;
        $papel->save();
        return response()->jason($papel);
    }
    public function add(Request $request)
    {
        $retorno= array();
        $retorno['sucesso']=false;
        session_start();
        if(isset($_SESSION['id'])){
           
       
        
        $papel = new Papel;
        $papel->nome = $request->nome;

        $papel->descricao = $request->descricao;
         
        $usuario= Usuario::findOrFail($_SESSION['id']);
        $papel->usuario()->associate($usuario);

    
      
        $resultado =$papel->save();
        if($resultado){
            $retorno['mensagem']= "Papel cadastrado com sucesso";
            $retorno['sucesso']=true;
            $retorno['papel']= $papel;
        }else
            $retorno['mensagem']= "Erro ao cadastrar papel";
        
       
        
    }else{
        $retorno['mensagem'] = "Você precisa estar logado para realizar esta ação";
       
    }
    return json_encode($retorno);
     
    
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('controleusuario::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('controleusuario::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update()
    {
    $papel = Papel::findOrFail($_POST['id']);
    $papel->nome =$_POST['nome'];
    $papel->descricao= $_POST['descricao'];
    $success =$papel->save();
    return json_encode($success);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy()
    {
        $res =Papel::where('id',$_POST['id'])->delete();
        return $res;
        //
    }
    public function atualizar(){
        $papel = Papel::findOrFail($_POST['id']);
        return json_encode($papel);
    }
}
