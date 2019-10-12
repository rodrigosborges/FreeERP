<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Funcionario extends Model
{
    protected $table = 'funcionario';
    use Notifiable;

    public function user(){
        return $this->belongsTo('Modules\Calendario\Entities\User');
    }

    public function setor(){
        return $this->belongsTo('Modules\Calendario\Entities\Setor');
    }

    public function agendas(){
        return $this->hasMany('Modules\Calendario\Entities\Agenda');
    }
}
