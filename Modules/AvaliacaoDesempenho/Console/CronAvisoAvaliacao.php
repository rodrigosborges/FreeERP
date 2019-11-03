<?php

namespace Modules\AvaliacaoDesempenho\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\AvaliacaoDesempenho\Entities\Avaliador;

class CronAvisoAvaliacao extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cron:avisos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Avisar Funcionarios sobre a data da Avaliação.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        Mail::send('avaliacaodesempenho::emails/_aviso', [], function($message) {
            $message->to('nikolasagl@hotmail.com', 'teste')->subject('Aviso');
        });

        $avaliadores = Avaliador::where('concluido', 0)->get();

        foreach ($avaliadores[0] as $key => $avaliador) {

            $validade = new DateTime($avaliador->validade);
            $hoje = date('Y-m-d');
            
            if ($hoje->diff($validade) <= 5) {

                if ($hoje->diff($validade) == 1) {
                    $data = [
                        'avaliador' => $avaliador,
                        'dias' => 1
                    ];        
                } else if ($hoje->diff($validade) < 3) {
                    $data = [
                        'avaliador' => $avaliador,
                        'dias' => 2
                    ];     
                } else {
                    $data = [
                        'avaliador' => $avaliador,
                        'dias' => 5
                    ];     
                }

                Mail::send('avaliacaodesempenho::emails/_aviso', $data, function($message) use($data) {
                    $message->to($data['avaliador']->funcionario->email->email, $data['avaliador']->funcionario->nome)->subject('Aviso');
                });
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
