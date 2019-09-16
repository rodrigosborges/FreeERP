<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setor';

    protected $fillable = ['nome'];

    //Relação com a tabela protocolos
    public function protocolos(){
        return $this->belongsTo('Modules\Protocolos\Entities\Protocolos');
    }

}
