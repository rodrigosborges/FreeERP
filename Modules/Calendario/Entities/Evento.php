<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Evento extends Model
{
    protected $table = 'evento';

    public function setDataInicioAttribute($value){
        $tags = explode(' ', $value);
        if(count($tags) == 2)
            $this->attributes['data_inicio'] = DateTime::createFromFormat('d/m/Y +H:i', $value)->format('Y-m-d H:i');
        else
            $this->attributes['data_inicio'] = DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setDataFimAttribute($value){
        $tags = explode(' ', $value);
        if(count($tags) == 2)
            $this->attributes['data_fim'] = DateTime::createFromFormat('d/m/Y +H:i', $value)->format('Y-m-d H:i');
        else
            $this->attributes['data_fim'] = DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function calendario(){
        return $this->belongsTo('Modules\Calendario\Entities\Agenda');
    }
}
