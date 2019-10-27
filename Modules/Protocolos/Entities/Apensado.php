<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Apensado extends Model
{
    protected $table = 'protocolo_apensado';

    protected $fillable = ['protocolo_id'];
    
    //Relação com a tabela protocolo
    public function protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Protocolo', '');
    }   
 
}
