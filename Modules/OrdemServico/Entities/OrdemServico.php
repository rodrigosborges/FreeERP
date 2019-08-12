<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    Use SoftDeletes;
    protected $table = 'ordem_servico';
    public $timestamps = true;
    protected $fillable = array('status','descricao','solicitante_id','aparelho_id','problema_id','tecnico_id','gerente_id');

    //relaçoes
    public function solicitante(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Solicitante');
    }
    public function tecnico(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Tecnico');
    }
    
    public function gerente(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Gerente');
    }
    
    public function aparelho(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Aparelho');
    }
    
    public function problema(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Problema');
    }



}
