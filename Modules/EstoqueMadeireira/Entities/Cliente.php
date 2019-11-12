<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use SoftDeletes;
    
    protected $table = 'clientes';
    protected $fillable = ['nome', 'telefone','documento', 'email'];

    // public function tipoDocumento(){
    //     return $this->hasOne('Modules\EstoqueMadeireira\Entities\TipoDocumento', 'tipoDocumento_id')->withTrashed();
    // }
    
    public function documento(){
        return $this->hasMany('Modules\EstoqueMadeireira\Entities\Documento')->withTrashed();

    }

    public function enderecos(){
        return $this->hasMany('Modules\EstoqueMadeireira\Entities\Endereco')->withTrashed();

    }
}

