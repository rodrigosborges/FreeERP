<?php

namespace Modules\Calendario\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Modules\Calendario\Entities\Evento;
use Modules\Calendario\Notifications\NotificarEventoProximo;

class EnviarNotificacaoEventoProximo extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'evento:notificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia notificações para um evento prestes à ocorrer';

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
     * Filtra os eventos que possuem solicitação de notificação e envia caso esteja no horário
     * Também notifica os convidados que aceitaram
     *
     * @return mixed
     */
    public function handle()
    {
        $eventos = Evento::whereHas('notificacao', function (Builder $query){
           $query->where('disparado', null);
        })->get();

        $bar_eventos = $this->output->createProgressBar(count($eventos));
        $bar_eventos->start();

        foreach ($eventos as $evento){
            if($evento->dia_todo){
                $data = Carbon::parse($evento->data_inicio)->format('d/m/Y');
            } else {
                $data = Carbon::parse($evento->data_inicio)->format('d/m/Y H:i');
            }

            if(Carbon::now() >= Carbon::create($data)->subSeconds($evento->notificacao->tempo * $evento->notificacao->periodo)){
                $evento->agenda->funcionario->user->notify(new NotificarEventoProximo($evento));
                foreach ($evento->convites as $convite){
                    if($convite->status == true){
                        $convite->funcionario->user->notify(new NotificarEventoProximo($evento));
                    }
                }
            }

            $evento->notificacao->disparado = true;
            $evento->notificacao->save();

            $bar_eventos->advance();
        }

        $bar_eventos->finish();
    }
}
