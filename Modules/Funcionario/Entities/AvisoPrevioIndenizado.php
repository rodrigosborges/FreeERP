<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisoPrevioIndenizado extends Model {
    
    protected $table = 'aviso_previo_indenizado';

    protected $fillable = ['data_inicio_aviso', 'dias_aviso_indenizado', 'tipo_reducao_aviso', 'aviso_previo_id'];

    public $timestamps = false;

    public function avisoPrevio(){
        return $this->belongsTo('Modules\Funcionario\Entities\AvisoPrevio');
    }
}
