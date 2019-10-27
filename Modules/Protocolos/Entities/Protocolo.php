<?php

namespace Modules\Protocolos\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    protected $table = 'protocolo';

    protected $fillable = ['assunto', 'tipo_protocolo_id', 'tipo_acesso_id', 'usuario_id'];

    //Relação com a tabela tipo_protocolo
    public function tipo_protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\TipoProtocolo');
    }

    //Relação com a tabela tipo_acesso
    public function tipo_acesso(){
        return $this->belongsTo('Modules\Protocolos\Entities\TipoAcesso');
    }

    //Relação com a tabela protocolo_has_usuario 
    public function interessado(){
        return $this->belongsToMany('Modules\Protocolos\Entities\Usuario', 'protocolo_has_usuario', 'protocolo_id', 'usuario_id');
    }

    //Relação com a tabela usuario
    public function usuario(){
        return $this->belongsTo('Modules\Protocolos\Entities\Usuario');
    }  

    public function tramite(){
        return $this->belongsTo('Modules\Protocolos\Entities\Tramite');
    } 

    public function apensados(){
        return $this->belongsToMany('Modules\Protocolos\Entities\Protocolo', 'protocolo_has_apensado', 'protocolo_id', 'apensado_id');
    }
}
