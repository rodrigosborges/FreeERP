<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacao';

    public function evento(){
        return $this->belongsTo('Modules\Calendario\Entities\Evento');
    }

    public function periodo_por_extenso(){
        switch ($this->periodo){
            case 60: $retorno = 'minutos'; break;
            case 3600: $retorno = 'horas'; break;
            case 86400: $retorno = 'dias'; break;
        }
        return $retorno;
    }
}
