<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;
use\Illuminate\Database\Eloquent\SoftDeletes;

class Papel extends Model
{
    use SoftDeletes;
    protected $table='papel';
    protected $fillable = ['nome','descricao'];
    public $timestamps=false;

    public function atuacoes()
    {
        return $this->hasMany('Modules\controleUsuario\Entities\Atuacao');
    }

    public function usuario()
    {
        return $this->belongsTo('Modules\controleUsuario\Entities\Usuario');
    }
}

