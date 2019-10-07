<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{
    protected $fillable = ['evento_id', 'funcionario_id'];
    protected $table = 'convite';

    public function evento(){
        return $this->belongsTo('Modules\Calendario\Entities\Evento');
    }

    public function funcionario(){
        return $this->belongsTo('Modules\Calendario\Entities\Funcionario');
    }
}
