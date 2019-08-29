<?php

namespace Modules\Protocolos\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    use SoftDeletes;

    protected $table = 'protocolo';

    protected $fillable = ['assunto', 'funcionario_id', 'tipo_protocolo_id', 'tipo_acesso_id'];

    //Relação com a tabela funcionário
    public function pessoaProtocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\pessoaProcolo');
    }

    //Relação com a tabela tipo_protocolo
    public function tipo_protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Tipo_protocolo');
    }

    //Relação com a tabela tipo_acesso
    public function tipo_acesso(){
        return $this->belongsTo('Modules\Protocolos\Entities\Tipo_acesso');
    }
}
