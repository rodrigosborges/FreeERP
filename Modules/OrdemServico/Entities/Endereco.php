<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    
    public $timestamps = false;
    protected $table = 'endereco';
    protected $fillable = array('cep','rua','bairro','cidade_id','estado_id','complemento','numero');

    
    public function cidade(){
        return $this->hasOne('Modules\OrdemServico\Entities\Cidade');
    }
    
    public function estado(){
        return $this->hasOne('Modules\OrdemServico\Entities\Estado');
    }
}
