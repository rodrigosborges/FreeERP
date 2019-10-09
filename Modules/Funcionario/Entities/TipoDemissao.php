<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoDemissao extends Model
{
    protected $table = ['tipo_demissao'];
    
    protected $fillable = ['tipo'];

    public $timestamps = false;

    public function demissao(){
        return $this->hasOne('Modules\Funcionario\Entities\Demissao');
    }
}
