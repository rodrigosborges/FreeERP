<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
    protected $table = 'complemento';

    protected $fillable = ['complemento', 'user_id', 'protocolo_id'];

    public $timestamps = false;

    //Relação com a tabela protocolo
    public function protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Protocolo');
    } 

    //Relação com a tabela usuario
    public function usuario(){
        return $this->belongsTo('Modules\Protocolos\Entities\Usuario', 'user_id');
    }  
}
