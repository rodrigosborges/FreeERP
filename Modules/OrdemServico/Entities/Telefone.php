<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    public $timestamps = false;
    protected $table = 'telefone';
    protected $fillable = array('numero','solicitante_id');

    public function solicitante(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Solicitante');
    }
}
