<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $fillable = ['nome'];
    use SoftDeletes;

    public function questoes() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Questao', 'categoria_id', 'id');
    }
}
