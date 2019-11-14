<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = ['nome'];

    //Relação com a tabela protocolos
    public function log(){
        return $this->belongsTo('Modules\Protocolos\Entities\Log');
    }

}
