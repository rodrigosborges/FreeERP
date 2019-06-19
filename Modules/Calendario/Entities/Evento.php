<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = ['titulo', 'data_inicio', 'hora_inicio', 'data_fim', 'hora_fim', 'nota'];

    public function calendario(){
        return $this->belongsTo('Modules\Calendario\Entities\Agenda');
    }
}
