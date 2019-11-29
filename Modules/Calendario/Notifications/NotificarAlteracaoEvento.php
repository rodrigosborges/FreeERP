<?php

namespace Modules\Calendario\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Calendario\Entities\Convite;

class NotificarAlteracaoEvento extends Notification
{
    use Queueable;
    private $convite;

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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('convites.ver', $this->convite->id);
        if ($this->convite->evento->dia_todo) {
            $data = Carbon::parse($this->convite->evento->data_inicio)->format('d/m/Y')
                . ' até ' . Carbon::parse($this->convite->evento->data_fim)->format('d/m/Y');
        } else {
            $data = Carbon::parse($this->convite->evento->data_inicio)->format('d/m/Y H:i')
                . ' até ' . Carbon::parse($this->convite->evento->data_fim)->format('d/m/Y H:i');
        }
        return (new MailMessage)
            ->from('erpedu@ifspcaraguatatuba.edu.br', 'ERPedu')
            ->subject('Alteração de evento')
            ->greeting('Olá!')
            ->line('Alteração em evento que você confirmou presença.')
            ->line('Evento: ' . $this->convite->evento->titulo)
            ->line('Responsável: ' . $this->convite->evento->agenda->funcionario->nome)
            ->line('Data: ' . $data)
            ->action('Ver o convite', $url);
    }
}
