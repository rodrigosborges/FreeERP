<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


class UsuarioController extends Controller
{
    protected $dadosTemplate;

    public function __construct() {

        /* Inicializa com o icone e nome padrao */

        // $papel = Papel::find()->where('idUsuario', '=', $idUsuario);
        $papel = 'administrador';
        $menu = [];

        switch ($papel) {
            case 'administrador':
                $menu = [
                    ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
                    ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
                    ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
                    ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
                ];
            break;
            default: $menu = []; 
        }

        $this->dadosTemplate = [
            'moduleInfo' => [
                'icon' => 'android',
                'name' => 'Controle de Usuario'
            ],
            'menu' => $menu,
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */


     public function inicio(){
         echo "pagina inicial";
     }
    public function index()
    {
        $data = ['url'=>'usuario.salvar', 'title'=>'Cadastro de Usuario'];
        return view('controleusuario::cadastrar', $this->dadosTemplate, compact('data'));

       // return view('controleusuario::cadastrar');
    }

    public function login()
    {
        $data= ['url'=>'validar.login', 'title'=>'Pagina de login'];
        return view('controleusuario::login', $this->dadosTemplate, compact('data'));
    }
 


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function validaLogin(Request $req){
        $data = ['email'=>$req->get('email')
                ,'password'=>$req->get('senha')];
      

        try{
            \Auth::attempt($data,false);
            return redirect()->route('user.dashboard');
        }catch(\Exception $ex){
            return $ex->getMessage();

        }
        // dd($req->all());
    }
    public function create()
    {
        return view('controleusuario::create');
    }

    //Cadastrar Usuário

    public function salvarCadastro(Request $req)
    {
        $dados = $req->all();
        dd($dados);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
}
