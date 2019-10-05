<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisoPrevioIndenizado extends Model {
    
    protected $table = 'aviso_previo_indenizado';

    protected $fillable = ['data_inicio_aviso', 'dias_aviso_indenizado', 'tipo_reducao_aviso', 'aviso_previo_id', 'aviso_previo_indicador_cumprimento_id'];

    public $timestamps = false;

    public function avisoPrevio(){
        return $this->belongsTo('Modules\Funcionario\Entities\AvisoPrevio');
    }

    public function avisoPrevioIndicadorCumprimento(){
        return $this->belongsTo('Modules\Funcionario\Entities\AvisoPrevioIndicadorCumprimento');
    }
}
