<?php
namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model {
    protected $table = 'curso';

    protected $fillable = ['nome', 'area_atuacao', 'duracao_horas_curso', 'data_realizacao', 'validade_curso', 'funcionario_id'];

    public function funcionario(){
        return $this->belongTo('Modules\Funcionario\Entities\Funcionario');
    }

}

