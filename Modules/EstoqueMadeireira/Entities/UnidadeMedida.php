<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;

class unidadeMedida extends Model
{
    protected $fillable = ['nome'];
    protected $table = 'unidade_medidas';


    // public function produto(){
    //     return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Produto')->withTrashed();
    // }

}
