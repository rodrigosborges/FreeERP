<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $fillable = ['cliente_id','endereco', 'complemento'];


    public function cliente(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Cliente')->withTrashed();
    }
}
