<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{
    protected $fillable = ['evento_id', 'funcionario_id'];
    protected $table = 'convite';

    public function evento()
    {
        return $this->belongsTo('Modules\Calendario\Entities\Evento');
    }

    public function funcionario()
    {
        return $this->belongsTo('Modules\Calendario\Entities\Funcionario');
    }

    public function getEventoJsonAttribute()
    {
        return [
            'id' => $this->evento->id,
            'title' => $this->evento->titulo,
            'start' => $this->evento->data_inicio,
            'end' => $this->evento->data_fim,
            'color' => '#' . $this->evento->agenda->cor->codigo,
            'agenda' => 'agenda' . $this->evento->agenda->id,
            'className' => 'agenda' . $this->evento->agenda->id,
            'descricao' => $this->evento->nota,
            'allDay' => $this->evento->dia_todo,
            'usuario' => $this->evento->agenda->funcionario->user->id
        ];
    }
}
