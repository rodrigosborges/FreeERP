<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setor';

    public function compartilhamentos(){
        return $this->hasMany('Modules\Calendario\Entities\Compartilhamento');
    }
}
