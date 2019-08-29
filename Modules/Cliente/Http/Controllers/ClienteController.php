<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Entities\{Telefone, Endereco, Email, Documento, TipoTelefone, Estado};
use Modules\Cliente\Entities\{Cliente, TipoCliente};
use Modules\Cliente\Http\Requests\CreateClienteRequest;
use DB;

class ClienteController extends Controller
{
    
    public function index()
    {
        return 'index';
    }

    
    public function create()
    {
        
        $tipo_cliente = TipoCliente::all();
        $tipo_telefone = TipoTelefone::all();
        $estados = Estado::all();
        return view('cliente::cliente.form', compact('tipo_cliente', 'tipo_telefone', 'estados'));
    }

    
    public function store(/*CreateClienteRequest*/Request $request) {

      
        DB::beginTransaction();
        try {

            $dados = $request->all();
            
            $endereco = Endereco::create($dados['endereco']);
            $email = Email::create($dados['email']);

            $tipo_documento_id = $dados['tipo_cliente_id'] == 1 ? 1 : 6;
            $documento = Documento::create([
                'numero' =>$dados['documento'],
                'tipo_documento_id' =>  $tipo_documento_id 
            ]);
              
            $cliente = Cliente::create([
                'nome' => $dados['nome'],
                'nome_fantasia' => $dados['nome_fantasia'],
                'tipo_cliente_id' => $dados['tipo_cliente_id'],
                'documento_id' => $documento->id,
                'endereco_id' => $endereco->id,
                'email_id' => $email->id
            ]);

            $telefones = $dados['telefones'];            
            foreach($telefones as $telefone){
                $tel = Telefone::create($telefone);
                $cliente->telefones()->attach($tel);
            }
            
            DB::commit();
            return redirect('/cliente/cliente')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (\Exception $e){
            DB::rollback();
            return back()->with('error', 'Ops! Ocorreu um erro.');
        }
        

        
    }

    // public function show($id)
    // {
    //     return view('cliente::show');
    // }

    public function edit($id)
    {
        return view('cliente::edit');
    }

    public function update(/*CreateCliente*/Request $request, $id){
            $dados = $request->all();

      
            $cliente = Cliente::findOrFail($id);

            $telefones_velhos =  $cliente->telefones;        

            $endereco = Endereco::findOrFail($cliente['endereco_id']);
            
            $email = Email::findOrFail($cliente['endereco_id']);

            $tipo_documento_id = $dados['tipo_cliente_id'] == 1 ? 1 : 6;
            $documento = Documento::findOrFail($cliente['documento_id']);
            

            $endereco->update($dados['endereco']);

            $email->update(['email' => $dados['email']]);

            $documento->update([
                'numero' =>$dados['documento'],
                'tipo_documento_id' =>  $tipo_documento_id 
            ]);
            $cliente->update([
                'nome' => $dados['nome'],
                'nome_fantasia' => $dados['nome_fantasia'],
                'tipo_cliente_id' => $dados['tipo_cliente_id'],
                'documento_id' => $documento->id,
                'endereco_id' => $endereco->id,
                'email_id' => $email->id
            ]);

            $naoExcluir = [];
            foreach($dados['telefones'] as $i => $telefone){
                if ($telefone['id']){                  
                    $tel = Telefone::findOrFail($telefone['numero']);                   
                    $tel->update($telefone);
                    
                }else{
                    $tel = Telefone::create($telefone);                    
                    $cliente->telefones()->attach($tel);
                }
                $naoExcluir[] = $tel->id;
            }

            $cliente->telefones()->whereNotIn('id', $naoExcluir)->delete();
            
            
            

            
            return redirect('/cliente')->with('success', 'Cliente cadastrado com sucesso!');
       
    }

    public function destroy($id)
    {
        $cliente = Cliente::withTrashed()->findOrFail($id);
        if($cliente->trashed()){
            $cliente->restore();
            return back()->with('success','Cliente restaurado com sucesso!');
        } else {
            $cliente->delete();
            return back()->with('success','Cliente deletado com sucesso!');
        }
    }
}