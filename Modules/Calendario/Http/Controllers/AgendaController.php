<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;

class AgendaController extends Controller
{
    public function criar(){
        return view('calendario::agendas.criar');
    }

    public function salvar(Request $request){
        try{
            $agenda = new Agenda();
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor = $request->agendaCor;
            $agenda->save();
        }catch (QueryException $e){
            dd($e);
        }
        return redirect()->route('agendas.criar')->with('success', 'Agenda ' . $agenda->titulo . ' criada com sucesso.');
    }

    public function teste(){
        return Agenda::find(1)->eventos->toJson();
    }

    public function eventos()
    {
        $calendario = [
            [
                'id' => 1,
                'title' => 'Curso',
                'start' => '2019-06-20 08:00',
                'end' => '2019-06-20 08:00',
                'backgroundColor' => 'red',
                'borderColor' => 'red',
                'classNames' => 'calendario01'
            ],
            [
                'id' => 2,
                'title' => 'Porra',
                'start' => '2019-06-23',
                'backgroundColor' => 'red',
                'borderColor' => 'red',
                'classNames' => 'calendario01'
            ],
            [
                'id' => 3,
                'title' => 'Porra',
                'start' => '2019-06-15',
                'end' => '2019-06-16',
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
                'classNames' => 'calendario02'
            ],
            [
                'id' => 4,
                'title' => 'Porra',
                'start' => '2019-06-10',
                'end' => '2019-06-11',
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
                'classNames' => 'calendario02'
            ]
        ];

        //$this->teste();

        return $calendario;
    }
}
