<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendario';
    protected $fillable = ['nome', 'descricao'];

    public function eventos(){
        return $this->hasMany('Modules\Calendario\Entities\Evento');
    }

    public function dono(){
        return null;
    }
}
