<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'calendario';
    protected $fillable = ['nome', 'descricao', 'cor'];

    public function eventos(){
        return $this->hasMany('Modules\Calendario\Entities\Evento');
    }

    public function dono(){
        return null;
    }
}