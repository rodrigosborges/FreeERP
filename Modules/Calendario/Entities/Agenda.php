<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use SoftDeletes;

    protected $table = 'agenda';

    public function cor(){
        return $this->belongsTo('Modules\Calendario\Entities\Cor');
    }

    public function eventos(){
        return $this->hasMany('Modules\Calendario\Entities\Evento')->orderBy('data_inicio');
    }

    public function compartilhamentos(){
        return $this->hasMany('Modules\Calendario\Entities\Compartilhamento');
    }

    public function funcionario(){
        return $this->belongsTo('Modules\Calendario\Entities\Funcionario');
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
               'descricao' => $evento->nota,
               'allDay' => $evento->dia_todo
            ]);
        }
        return $eventos;
    }

}
