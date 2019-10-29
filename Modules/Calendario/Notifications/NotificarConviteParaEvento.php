<?php

namespace Modules\Calendario\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Calendario\Entities\Convite;
use Modules\Calendario\Entities\Evento;

class NotificarConviteParaEvento extends Notification
{
    use Queueable;
    private $evento;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Convite $convite)
    {
        $this->convite = $convite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('convites.aceitar', $this->convite->id);
        if($this->convite->evento->dia_todo){
            $data = Carbon::parse($this->convite->evento->data_inicio)->format('d/m/Y')
                . ' até ' . Carbon::parse($this->convite->evento->data_fim)->format('d/m/Y');
        }
        else{
            $data = Carbon::parse($this->convite->evento->data_inicio)->format('d/m/Y H:i')
                . ' até ' . Carbon::parse($this->convite->evento->data_fim)->format('d/m/Y H:i');
        }
        return (new MailMessage)
                    ->greeting('Olá!')
                    ->subject('Convite para evento')
                    ->line('Você foi convidado para um evento.')
                    ->line('Evento: ' .  $this->convite->evento->titulo)
                    ->line('Responsável: ' . $this->convite->evento->agenda->funcionario->nome)
                    ->line('Data: ' . $data)
                    ->action('Confirme sua presença', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable){
        return [
            'convite_id' => $this->convite->id
        ];
    }
}
