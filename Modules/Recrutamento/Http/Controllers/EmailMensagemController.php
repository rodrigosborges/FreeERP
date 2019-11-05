<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Recrutamento\Entities\{Email};
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailMensagemController extends Controller
{
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
            ['icon' => 'email', 'tool' => 'Emails', 'route' => '/recrutamento/email'],
            ['icon' => 'power_settings_new', 'tool' => 'Logout', 'route' => '/logout'],
		];
    }


    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'emails'		=> Email::all(),
			'emails_inativos'		=> Email::onlyTrashed()->get(),
			'title'		=> "Email",
		]; 
        return view('recrutamento::email.index', compact('data','moduleInfo','menu'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'url'       => url('recrutamento/email'), 
            'title'		=> "Cadastro de Email",
            'button'    => "Salvar",
            'model'     => null,
            "voltar"    => url('recrutamento/email'),
		]; 
        return view('recrutamento::email.form', compact('data','moduleInfo','menu'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $emails = Email::all();
        foreach($emails as $email){
            if(strtoupper($request->email) == strtoupper($email->email)){
                return back()->with('error', 'Esse email já existe');
            }
        }

        DB::beginTransaction();
		try{    
            $email = Email::Create($request->all());          
			DB::commit();
			return redirect('/recrutamento/email')->with('success', 'Email cadastrado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'url'       => url('recrutamento/email/'.$id), 
            'title'		=> "Atualziação de Email",
            'button'    => "Atualizar",
            'model'     => Email::findOrFail($id),
            "voltar"    => url('recrutamento/email'),
		]; 
        return view('recrutamento::email.form', compact('data','moduleInfo','menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $emails = Email::all();
        foreach($emails as $email){
            if($email->id != $id){
                if(strtoupper($request->email) == strtoupper($email->email)){
                    return back()->with('error', 'Email já existe');
                }
            }
        }

        DB::beginTransaction();
		try{    
            $email = Email::FindOrFail($id);
            $email->update($request->all());          
			DB::commit();
			return redirect('/recrutamento/email')->with('success', 'Email atualizado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
		try{    
            $email = Email::FindOrFail($id);
            $email->delete();          
			DB::commit();
			return redirect('/recrutamento/email')->with('success', 'Email deletado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $email = Email::onlyTrashed()->where('id', $id)->first();
            $email->restore();          
			DB::commit();
			return redirect('/recrutamento/email')->with('success', 'Email restaurado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

}
