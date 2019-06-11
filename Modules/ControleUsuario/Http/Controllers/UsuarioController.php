<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\controleUsuario\Entities\Papel;
use Modules\controleUsuario\Entities\Modulo;
use Modules\controleUsuario\Entities\Usuario;
use Modules\controleUsuario\Http\Requests \ {
    ValidaLoginRequest
};
use Modules\controleUsuario\Http\Requests \ {
    ValidaCadastroRequest
};
//use Modules\ControleUsuario\Entities\{Usuario};
use DB;
use PHPUnit\Runner\Exception;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    protected $dadosTemplate;

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

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->viewAutenticar();
    }

    public function viewAutenticar()
    {
        return view('controleusuario::login', $this->dadosTemplate);
    }

    public function viewCadastro()
    {
        $data = ['url' => '/cadastrar', 'model' => null, 'button' => 'Cadastrar', 'title' => 'Cadastrar Usuário'];

        return view('controleusuario::form', $this->dadosTemplate, compact('data'));
    }





    public function cadastrar(ValidaCadastroRequest $req)
    {

        DB::beginTransaction();
        try {

            $usuario = DB::table('usuario')->where('email', $req->email)->first();


            if (!$usuario) {
                DB::commit();
                $data =array();
                $data['nome']= $req->input('name');
                $data['email']= $req->input('email');  
                $data['senha']=  base64_encode($req->input('password'));

                $data['url'] = 'validar.cadastro';
                $data['model'] = null;
                
                $data['title'] = 'Cadastrar Usuário';
                Usuario::Create($data);
                return back()->with('success', 'Usuário cadastrado com sucesso!');
            } else {
                return back()->with('warning', 'Este email já está cadastrado');
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', $e);
        }
    }

    public function validaLogin(ValidaLoginRequest $req)
    {

        $senha =  base64_encode($req->password);
        $user = DB::table('usuario')->where('email', $req->email)->Where('senha', $senha)->first();

        if ($user != null) {
            session_start();

            $_SESSION['id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['nome'] = $user->nome;
            $data = ['usuario' => $user, 'url' => '/dashboard', 'title' => 'Pagina inicial'];
            return view('controleusuario::dashboard', $this->dadosTemplate, compact('data'));
        } else {
            echo "usuario não encontrado<br>";
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    { }


    public function logoff()
    {
        session_start();
        session_destroy();
        return view('controleusuario::login', $this->dadosTemplate);
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




    // Metodo utilizado quando a view é aberta a primeira vez
    public function consulta()
    {
        $status = ['0' => "Ativo e inativos", '1' => "Somente ativos", '2' => "Somente inativos"];
        $modulos = ['0' => "Todos os módulos", '1' => "Recursos Humanos", '2' => "Vendas", '3' => "Estoque"];
        $cargos = ['0' => "Administradores", '1' => "Gerentes", '2' => "Operadores"];

        $lista = Usuario::withTrashed()->get();

        return view(
            'controleusuario::consulta',
            $this->dadosTemplate,
            compact('status', 'modulos', 'cargos', 'lista')
        );
    }

    public function buscar(Request $req){
        $status = ['0' => "Ativo e inativos", '1' => "Somente ativos", '2' => "Somente inativos"];
        $modulos = ['0' => "Todos os módulos", '1' => "Recursos Humanos", '2' => "Vendas", '3' => "Estoque"];
        $cargos = ['0' => "Administradores", '1' => "Gerentes", '2' => "Operadores"];
        $lista = Usuario::withTrashed()->get();

        $texto = "";

        foreach ($req->request as $key => $value) {
            switch($key){
                case 'nome':
                    if( isset($value) ){
                        $texto = $texto. $value;
                        echo($texto);
                    }
                break;
                case 'data':
                if( isset($value) ){
                    $texto = $texto. $value;
                    echo($texto);
                }
                break;
                case 'status':
                if( isset($value) ){
                    $texto = $texto. $value;
                    echo($texto);
                }
                break;
                case 'modulo':
                if( isset($value) ){
                    $texto = $texto. $value;
                    echo($texto);
                }
            }
        }
        
        if( isset($req->nome)){
            $lista = DB::table('usuario')->select()->where(
                'nome', $req->nome
            )->get();
        }else{
            echo("TB");
        }

        return view(
            'controleusuario::consulta',
            $this->dadosTemplate,
            compact('status', 'modulos', 'cargos', 'lista')
        );

    }

    public function recovery(Request $req){
        $user = Usuario::onlyTrashed()
        ->where('id', $req->id );

        
        $user->restore();
        return redirect()->back()->with('Success','IT WORKS!');

    }

    public function editar(Request $req)
    {

        $data['model'] = Usuario::find($req->input('id'));
        $data['url'] = 'validar.edicao';
        $data['button'] = 'Atualizar';
        $data['title'] = 'Editar Usuário';


        return view('controleusuario::form', $this->dadosTemplate, compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */



    public function update(Request $request)
    {

        $usuario = Usuario::findOrFail($request->id);

        $email = DB::table('usuario')->where('email', $request->email)->where('id', '<>', $request->id)->first();

        $data = [
            'title' => 'Editar Usuario',
            'url' => 'validar.edicao',
            'button' => 'Atualizar',
        ];
        $data['model'] = $usuario;

        if (!$email) {
            // email disponivel
            try {
                echo "email valido";


                if ($request->password == "") {
                    echo "senha vazia";

                    $usuario->senha = $usuario->senha;
                    $usuario->save();
                } else {
                    $usuario->senha = base64_encode($request->password);
                }
                $usuario->email = $request->email;
                $usuario->nome = $request->name;
                $usuario->save();
                return view('controleusuario::form', $this->dadosTemplate, compact('data'))->with('success','Dados atualizados com sucesso');
            } catch (Exception $e) {
                DB::rollback();
                echo "não foi";
                return back()->with('error','Erro ao atualizar :'.$e->getMessage());

            }
        }else{
            return back()->with('warning','Email indisponível');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */

    public function destroy(Request $req)
    {
        $id = $req->input('id');
        $res = Usuario::where('id', $id)->delete();
        if ($res) {
            $data = ['status' => '1', 'msg' => 'success'];
        } else
        $data = ['status' => '0', 'msg' => 'fail'];

        return back()->with('data');
    }
    public function buscarModulos(){
        $modulos = Modulo::all();
        $papeis = Papel::all();

        $retorno=array();
        $retorno['modulos']=$modulos;
        $retorno['papeis']=$papeis;
        return json_encode($retorno);
        
    }
}
