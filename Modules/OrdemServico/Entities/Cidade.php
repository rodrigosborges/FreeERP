<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public $timestamps = false;
    protected $table = 'cidade';
    protected $fillable = array('nome','estado_id');

    public function estado(){
        return $this->belongsTo('Modules\OrdemServico\Entities\Estado');
    }
}
