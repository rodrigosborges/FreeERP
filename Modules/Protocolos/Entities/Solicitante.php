<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'solicitante';

    protected $fillable = ['nome'];

    //Relação com a tabela protocolo.
    public function protocolo(){
        return $this->hasMany('Modules\Protocolos\Entities\Protocolo');
    }
}
