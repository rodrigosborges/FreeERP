<?php

namespace Modules\Protocolos\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    protected $table = 'protocolo';

    protected $fillable = ['solicitante_id', 'assunto', 'tipo_protocolo_id', 'tipo_acesso_id'];

    //Relação com a tabela solicitante
    public function solicitante(){
        return $this->belongsTo('Modules\Protocolos\Entities\Solicitante');
    }

    //Relação com a tabela tipo_protocolo
    public function tipo_protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Tipo_protocolo');
    }

    //Relação com a tabela tipo_acesso
    public function tipo_acesso(){
        return $this->belongsTo('Modules\Protocolos\Entities\Tipo_acesso');
    }

    //Relação com a tabela interessado 
    public function interessado(){
        return $this->belongsToMany('Modules\Protocolos\Entities\Interessado');
    }
}
