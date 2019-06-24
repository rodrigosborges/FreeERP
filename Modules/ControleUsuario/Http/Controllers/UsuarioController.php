<?php

namespace Modules\ControleUsuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\controleUsuario\Entities\Papel;
use Modules\controleUsuario\Entities\Atuacao;
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
        
        session_start();
        $this->verificaLogado();
     
        $data = ['url' => '/cadastrar', 'model' => null, 'button' => 'Cadastrar', 'title' => 'Cadastrar Usuário'];
    
        
        return view('controleusuario::form', $this->dadosTemplate, compact('data'));
    }





    public function cadastrar(ValidaCadastroRequest $req)
    {
        DB::beginTransaction();
        try {

            $usuario = DB::table('usuario')->where('email', $req->email)->first();


            if (!$usuario) {

                $data =array();
                $data['nome']= $req->input('name');
                $data['email']= $req->input('email');
                $data['senha']=  base64_encode($req->input('password'));

                $data['url'] = 'validar.cadastro';
                $data['model'] = null;

                $data['title'] = 'Cadastrar Usuário';
                Usuario::Create($data);
                DB::commit();
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
/*
 $menu = [
                ['icon' => 'vpn_key', 'tool' => 'Login', 'route' => '/controleusuario/autenticar'],
                ['icon' => 'people', 'tool' => 'Usuarios', 'route' => '/controleusuario/cadastrar'],
                ['icon' => 'event_note', 'tool' => 'Papéis', 'route' => '/controleusuario/papel'],
                 ['icon' => 'list_alt', 'tool' => 'Relatórios', 'route' => '/controleusuario/consulta'],
                ['icon' => 'toggle_off', 'tool' => 'Sair', 'route' => '/controleusuario/sair'],
            ];
*/
        $senha =  base64_encode($req->password);
        $user = DB::table('usuario')->where('email', $req->email)->Where('senha', $senha)->first();

        if ($user != null) {
           $this->verificaLogado();
         //   dd($this->dadosTemplate['menu']);
            session_start();

            $_SESSION['id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['nome'] = $user->nome;
            $usuario = Usuario::findOrFail($user->id);
            $this->verificaLogado();
            $data = ['usuario' => $user, 'url' => '/dashboard', 'title' => 'Pagina inicial'];
            return view('controleusuario::dashboard', $this->dadosTemplate, compact('data','usuario'));
        } else {
            echo "usuario não encontrado";
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->verificaLogado();
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
$retorno = array();
        $retorno['sucesso']=false;
        DB::beginTransaction();
        try{
            $data = array();
            $email = DB::table('usuario')->where('email', $request->email)->first();
            if(!$email){

               $usuario = new Usuario();
               $usuario->nome =$request->nome;
               $usuario->email =$request->email;
               $usuario->senha = base64_encode($request->senha);
               $usuario->save();

               if($request->modulo!=null && $request->modulo!=""){
                   $atuacao = new Atuacao();
                   $atuacao->usuario_id =$usuario->id;
                   $atuacao->modulo_id = $request->modulo;
                   $atuacao->papel_id = $request->papel;
                   $atuacao->save();

               }
               DB::commit();
               $retorno['mensagem']="Usuário Cadastrado com sucesso";
               $retorno['sucesso']=true;


            }else{
                $retorno['mensagem']="Este email já está em uso no momento";
            }
        }catch(Exception $ex){
            $retorno['mensagem']= "Erro ->". $ex;

            DB::rollback();
        }
        return json_encode($retorno);
    }


    public function logoff()
    {
        session_start();
        session_destroy();
        return view('controleusuario::login', $this->dadosTemplate);
    }
    public function dashboard(){
        session_start();
       $usuario = Usuario::find($_SESSION['id']);
        $data = [ 'title' => 'Pagina inicial'];
        $this->verificaLogado();
        return view('controleusuario::dashboard', $this->dadosTemplate, compact('data','usuario'));
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
       session_start();
        $this->verificaLogado();
        $status = ['0' => "Ativo e inativos", '1' => "Somente ativos", '2' => "Somente inativos"];
        // $modulos = ['0' => "Todos os módulos", '1' => "Recursos Humanos", '2' => "Vendas", '3' => "Estoque"];
        $cargos = ['0' => "Administradores", '1' => "Gerentes", '2' => "Operadores"];
        
        $modulos = Modulo::pluck('nome');
            
            if( $modulos->isEmpty() )
                $modulos = ['Sem modulos cadastrados'];
            else{
                $modulos->prepend("Todos os Módulos");
            }

        $lista = Usuario::withTrashed()->get();

            
        return view(
            'controleusuario::consulta',
            $this->dadosTemplate,
            compact('status', 'modulos', 'cargos', 'lista')
        );
    }


    public function buscar(Request $req){
        $status = ['0' => "Ativos e inativos", '1' => "Somente ativos", '2' => "Somente inativos"];
        $cargos = ['0' => "Administradores", '1' => "Gerentes", '2' => "Operadores"];
        
        $modulos = Modulo::pluck('nome');
            
            if( $modulos->isEmpty() )
                $modulos = ['Sem modulos cadastrados'];
            else{
                $modulos->prepend("Todos os Módulos");
            }

        $lista = DB::table('usuario')->select("*");
        
        foreach ($req->request as $key => $value) {
            if( $key !="_token" ){
                if( isset($value) ){
                    
                    switch ($key){
                        case "nome":
                            $lista -> where('nome', 'like', '%'.$value.'%');
                            break;
                        case "data":
                            //$lista->where('created_at', $value) -> get();
                            break;
                        case "status":
                            switch ($value){
                                case "0":
                                    // dd($value. '    '.$key);                                    
                                break;
                                case "1":
                                    $lista->whereNull("deleted_at");
                                break;
                                case "2":
                                dd($key);
                                    $lista->whereNotNull("deleted_at");
                                break;
                            }
                        break;
                            case "modulo":
                                switch ($value){
                                    case "0":
                                        // Padrao. Todos os modulos
                                    break;
                                        
                                    case "1":
                                    dd($modulos[$value]);                                     
                                    $lista-> rightJoin('atuacao','usuario.id','=','atuacao.usuario_id');
                                    break;

                                    case "2":
                                    dd($value. '    '.$key);                                    
                                    $lista-> leftJoin('atuacao','usuario.id','=','atuacao.usuario_id');
                                    break;
                                }
                        break;

                    }
                }
            }
        }
        $lista = $lista->get();
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
        $retorno=array();
        $retorno['sucesso']=false;
        $usuario = Usuario::findOrFail($request->id);
        $email = DB::table('usuario')->where('email', $request->email)->where('id', '<>', $request->id)->first();
        if (!$email) {
            // email disponivel
            try {
                if ($request->senha == "") {
                    $usuario->senha = $usuario->senha;
                    $usuario->save();
                }else
                    $usuario->senha = base64_encode($request->senha);

                $usuario->email = $request->email;
                $usuario->nome = $request->nome;
                $usuario->save();
                if($request->modulo!=null && $request->modulo!=""){
                    $atuacao = new Atuacao();
                    $atuacao->usuario_id =$usuario->id;
                    $atuacao->modulo_id = $request->modulo;
                    $atuacao->papel_id = $request->papel;
                    $atuacao->save();
                }
                $retorno['mensagem']="Usuario atualizado com sucesso";
                $retorno['sucesso']=true;
            } catch (Exception $e) {
                DB::rollback();

                $retorno['mensagem'] = "erro" . $e->getMessage();

            }
        }else{
           $retorno['mensagem']='Email indisponível';
        }
        return json_encode($retorno);
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
    public function verificaLogado(){
        
        if(isset($_SESSION['id'])){
            array_shift($this->dadosTemplate['menu']);
            array_unshift($this->dadosTemplate['menu'], ['icon'=>'assignment_ind', 'tool'=>$_SESSION['nome'], 'route'=>'/controleusuario/dashboard']);
        }
    }
}
