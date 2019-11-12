<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Endereco extends Model
{
    use SoftDeletes;
    protected $table = 'enderecos';
    protected $fillable = ['cliente_id','endereco', 'complemento'];


    public function cliente(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Cliente')->withTrashed();
    }
}
