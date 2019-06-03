<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Modules\controleUsuario\Entities\Papel;
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
                    ['icon' => 'person', 'tool' => 'Autenticar', 'route' => '/controleusuario/autenticar'],
                    ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/controleusuario/cadastrar'],
                    ['icon' => 'search', 'tool' => 'Buscar', 'route' => '/controleusuario/consulta'],
                    ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
                    ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
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
        $papeis = Papel::all();

        return view('controleusuario::papel.index', $this->dadosTemplate, compact('papeis'));
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
        $retorno = array();
        $papel = new Papel;
        $papel->nome = $request->nome;
        $papel->descricao = $request->descricao;
        $papel->save();
     
       $retorno="Papel cadastrado com sucesso";
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
