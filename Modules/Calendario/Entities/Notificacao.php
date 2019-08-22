<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacao';

    public function evento(){
        return $this->belongsTo('Modules\Calendario\Entities\Evento');
    }
}
