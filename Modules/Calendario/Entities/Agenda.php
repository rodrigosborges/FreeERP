<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    public function eventos(){
        return $this->hasMany('Modules\Calendario\Entities\Evento');
    }

    public function cor(){
        return $this->belongsTo('Modules\Calendario\Entities\Cor');
    }

    public function dono(){
        return null;
    }

    public function getEventosJsonAttribute(){
        $eventos = [];
        foreach ($this->eventos as $evento){
            array_push($eventos, [
               'id' => $evento->id,
               'title' => $evento->titulo,
               'start' => $evento->data_inicio,
               'end' => $evento->data_fim,
               'backgroundColor' => '#' . $this->cor->codigo,
               'borderColor' => '#' . $this->cor->codigo,
               'classNames' => 'agenda' . $this->id,
               'allDay' => $evento->dia_todo
            ]);
        }
        return $eventos;
    }

}