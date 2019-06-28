<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = ['titulo', 'data_inicio', 'hora_inicio', 'data_fim', 'hora_fim', 'nota'];

    public function setDataInicioAttribute($value){
        $data = DateTime::createFromFormat('d/m/Y', $value);
        $this->attributes['data_inicio'] = date_format($data, 'Y-m-d');
    }

    public function calendario(){
        return $this->belongsTo('Modules\Calendario\Entities\Agenda');
    }
}
