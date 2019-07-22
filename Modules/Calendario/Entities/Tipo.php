<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'agenda_tipo';

    public function agendas(){
        return $this->hasMany('Modules\Calendario\Entities\Agenda');
    }
}
