<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Compartilhamento extends Model
{
    protected $table = 'compartilhamento';
    protected $fillable = ['setor_id', 'agenda_id', 'funcionario_id'];

    public function agenda(){
        return $this->belongsTo('Modules\Calendario\Entities\Agenda');
    }

    public function setor(){
        return $this->belongsTo('Modules\Calendario\Entities\Setor');
    }

    public function aprovacao(){
        return $this->hasOne('Modules\Calendario\Entities\Aprovacao');
    }

    public function funcionario(){
        return $this->belongsTo('Modules\Calendario\Entities\Funcionario');
    }
}
