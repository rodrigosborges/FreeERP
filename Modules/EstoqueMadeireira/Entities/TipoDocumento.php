<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class tipoDocumento extends Model
{
    protected $fillable = ['nome'];
    protected $table = 'tipo_documentos';


    public function Documento(){
        
    }
}
