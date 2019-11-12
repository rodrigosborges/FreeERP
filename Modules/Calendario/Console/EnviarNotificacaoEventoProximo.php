<?php

namespace Modules\Calendario\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Modules\Calendario\Entities\Evento;
use Modules\Calendario\Http\Controllers\EventoController;
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
        //Recupera todos eventos que ainda não foram disparados notificações
        $eventos = Evento::whereHas('notificacao', function (Builder $query){
           $query->where('disparado', null);
        })->get();

        //Exibe barra de progresso no console
        $bar_eventos = $this->output->createProgressBar(count($eventos));
        $bar_eventos->start();

        //Formata a data de acordo com o tipo do evento
        foreach ($eventos as $evento){
            if($evento->dia_todo){
                $data_inicial = Carbon::parse($evento->data_inicio)->format('Y-m-d');
            } else {
                $data_inicial = Carbon::parse($evento->data_inicio)->format('Y-m-d H:i');
            }

            //Adiciona à hora atual o tempo da notificação
            $data_notificacao = Carbon::now()->addSeconds($evento->notificacao->tempo * $evento->notificacao->periodo)->format('Y-m-d H:i');

            //Verifica se a hora atual + tempo de notificação é superior ou igual à hora da solicitação de notificação
            //Essa seria a hora do disparo da notificação
            if($data_notificacao >= $data_inicial){
                //Envia a notificação ao dono do evento
                $evento->agenda->funcionario->user->notify(new NotificarEventoProximo($evento));
                //Verifica os convites e dispara notificação para os aceitos
                foreach ($evento->convites as $convite){
                    if($convite->status == true){
                        $convite->funcionario->user->notify(new NotificarEventoProximo($evento));
                    }
                }
                //Atualiza a notificação do evento como já disparada, para não ocorrer novamente
                $evento->notificacao->disparado = true;
                $evento->notificacao->save();
            }

            //Avanço da barra
            $bar_eventos->advance();
        }

        //Finaliza a barra
        $bar_eventos->finish();
    }
}
