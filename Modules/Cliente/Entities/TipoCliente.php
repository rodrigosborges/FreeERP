<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    protected $table = "tipo_cliente";    
    protected $fillable = ['nome'];

    public function clientes(){
        return $this->hasMany('Modules\Cliente\Entities\Cliente');
    }
    
}
