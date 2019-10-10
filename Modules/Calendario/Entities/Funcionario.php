<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionario';

    public function setor(){
        return $this->belongsTo('Modules\Calendario\Entities\Setor');
    }

    public function agendas(){
        return $this->hasMany('Modules\Calendario\Entities\Agenda');
    }
}
