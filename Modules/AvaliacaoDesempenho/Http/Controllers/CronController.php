<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Avaliador;

class CronController extends Controller 
{
    public function avisos() {
        $avaliadores = Avaliador::where('concluido', 0)->get();

        foreach ($avaliadores as $key => $avaliador) {
            
            $validade = strtotime(implode('-', array_reverse(explode('/', $avaliador->validade))));
            $hoje = strtotime(date('Y-m-d'));            
            $diferenca = ($validade - $hoje)/60/60/24;

            if ($diferenca <= 5) {
                $data['avaliador'] = $avaliador;

                if ($diferenca == 1) {
                    $data['dias'] = 1;     
                } else if ($diferenca < 3) {
                    $data['dias'] = 2; 
                } else {
                    $data['dias'] = 5;
                }

                Mail::send('avaliacaodesempenho::emails/_aviso', $data, function($message) use($data) {
                    $message->to($data['avaliador']->funcionario->email->email, $data['avaliador']->funcionario->nome)->subject('Aviso');
                });
            }
        }
        return redirect('/avaliacaodesempenho/avaliacao')->with('success', 'Cron Executada com Sucesso');
    }
}