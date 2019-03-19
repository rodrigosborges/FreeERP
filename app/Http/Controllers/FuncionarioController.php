<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    
    public function index()
    {
        
    }
    
    public function create()
    {
        $data = [
            'url' => '',
            'model' => '',
            'title' => 'Cadastro de Funcionário'
        ];

        return view('funcionario.form', compact('data'));
    }

    public function store(Request $request)
    {
        
    }
   
    public function show($id)
    {
       
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy($id)
    {
        
    }
}
