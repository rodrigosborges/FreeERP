<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class tipoDocumento extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome'];
    protected $table = 'tipo_documentos';


    public function Cliente(){
        return $this->belongsToMany('Modules\EstoqueMadeireira\Entities\Cliente', 'Documento', 'cliente_id', 'tipoDocumento_id')->withTrashed();
    }
}
