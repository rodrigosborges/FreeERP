<?php

namespace Modules\Calendario\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Calendario\Entities\Evento;

class NotificarEventoProximo extends Notification
{
    use Queueable;
    private $evento, $data;

    /**
     * Create a new notification instance.
     * Faz um parse da data de ínicio de acordo com o tipo do evento (dia-todo ou não)
     *
     * @param Evento $evento
     */
    public function __construct(Evento $evento)
    {
        if($evento->dia_todo){
            $this->data = Carbon::parse($evento->data_inicio)->format('d/m/Y');
        } else {
            $this->data = Carbon::parse($evento->data_inicio)->format('d/m/Y H:i');
        }
        $this->evento = $evento;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->evento->notificacao->email == true ? ['broadcast', 'mail'] : ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('erpedu@ifspcaraguatatuba.edu.br', 'ERPedu')
                    ->subject('Evento prestes a ocorrer')
                    ->greeting('Olá!')
                    ->line('O evento "' . $this->evento->titulo . '" está prestes a ocorrer.')
                    ->line('Início: ' . $this->data)
                    ->line('Não se atrase.');
    }

    /**
     * Representação da notificação via broadcast(navegador).
     *
     * @param $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable){

        return new BroadcastMessage([
            'title' => 'Evento prestes a ocorrer',
            'message' => 'O evento <strong>' . $this->evento->titulo . '</strong> vai iniciar em ' . $this->data . '.'
        ]);
    }
}
