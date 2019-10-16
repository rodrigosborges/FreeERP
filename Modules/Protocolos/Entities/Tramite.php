<?php

namespace Modules\Protocolos\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    

    protected $table = 'tramite';

    protected $fillable = ['observacao','status', 'origem', 'destino', 'protocolo_id'];
    
    //Relação com a tabela protocolo
    public function protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Protocolo');
    }   

    //Relação com a tabela usuario
    public function origem_usuario(){
        return $this->belongsTo('Modules\Protocolos\Entities\Usuario', 'origem');
    } 

    //Relação com a tabela usuario
    public function destino_usuario(){
        return $this->belongsTo('Modules\Protocolos\Entities\Usuario', 'destino');
    } 
}

