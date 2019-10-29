<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisoPrevioIndicadorCumprimento extends Model {
    
    protected $table = 'aviso_previo_indicador_cumprimento';

    protected $fillable = ['tipo_cumprimento'];

    public $timestamps = false;

    public function avisoPrevioIndenizado(){
        return $this->hasOne('Modules\Funcionario\Entities\AvisoPrevioIndenizado');
    }
}
