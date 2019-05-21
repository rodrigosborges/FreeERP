<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    use SoftDeletes;

     protected $table = 'ordem_servico';

    protected $fillable = ['solicitante_id','tipo_aparelho','marca','numero_serie','descricao_problema','status','prioridade'];

    public function solicitante(){
        return $this->hasOne('Modules\OrdemServico\Entities\Solicitante');
    }
}
