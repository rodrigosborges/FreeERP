<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'doc_protocolo';

    protected $fillable = ['nome_documento', 'documento', 'protocolo_id'];

    public $timestamps = false;

    //Relação com a tabela protocolo
    public function protocolo(){
        return $this->belongsTo('Modules\Protocolos\Entities\Protocolo');
    } 
}
