<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    public function setor(){
        return $this->belongsTo('Modules\Calendario\Entities\Setor');
    }

    public function cor(){
        return $this->belongsTo('Modules\Calendario\Entities\Cor');
    }

    public function eventos(){
        return $this->hasMany('Modules\Calendario\Entities\Evento');
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
               'color' => '#' . $this->cor->codigo,
               'agenda' => 'agenda' . $this->id,
               'className' => 'agenda' . $this->id,
               'allDay' => $evento->dia_todo
            ]);
        }
        return $eventos;
    }

}
