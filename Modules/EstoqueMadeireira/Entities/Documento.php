<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class documento extends Model
{
    protected $table = 'documentos';
    protected $fillable = ['nome', 'tipoDocumento_id', 'cliente_id'];


    public function tipoDocumento(){
        return $this->hasOne('Modules\EstoqueMadeireira\Entities\TipoDocumento')->withTrashed();
    }

    
}

