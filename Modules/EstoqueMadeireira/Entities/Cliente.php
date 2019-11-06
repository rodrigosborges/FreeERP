<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['nome', 'telefone'];

    public function documento(){
        return $this->hasMany('Modules\EstoqueMadeireira\Entities\Documento')->withTrashed();

    }

    public function endereco(){
        return $this->hasOne('Modules\EstoqueMadeireira\Entities\Endereco')->withTrashed();

    }
}

