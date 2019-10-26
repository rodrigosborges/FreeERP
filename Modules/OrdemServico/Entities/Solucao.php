<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

class Solucao extends Model
{
    public $timestamps = false;
    protected $table = 'solucao';
    protected $fillable = array('descricao','problema_id');
    
    public function problema(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Problema');
    }
}
