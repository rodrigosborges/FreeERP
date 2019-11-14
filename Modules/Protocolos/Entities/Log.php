<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = true;

    protected $table = 'log';

    protected $fillable = ['status_id', 'usuario_id', 'protocolo_id'];


    //Relação com a tabela status
    public function status(){
        return $this->belongsTo('Modules\Protocolos\Entities\Status');
    }
    
    //Relação com a tabela usuario
    public function usuario(){
        return $this->belongsTo('Modules\Protocolos\Entities\Usuario');
    } 

    //Relação com a tabela protocolo
    public function protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Protocolo');
    }
}
