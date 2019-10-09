<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class AvisoPrevio extends Model {
    
    protected $table = 'aviso_previo';

    protected $fillable = ['aviso_previo_indenizado', 'descontar_aviso_previo', 'funcionario_id'];

    public $timestamps = false;

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario');
    }

    public function avisoPrevioIndenizado(){
        return $this->hasOne('Modules\Funcionario\Entities\AvisoPrevioIndenizado');
    }
}