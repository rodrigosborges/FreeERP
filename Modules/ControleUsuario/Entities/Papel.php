<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{

    protected $table='papel';
    protected $fillable = ['nome','descricao'];
    public $timestamps=false;

    public function atuacoes()
    {
        return $this->hasMany('Modules\controleUsuario\Entities\Atuacao');
    }

    public function usuarios()
    {
        return $this->belongsTo('Modules\controleUsuario\Entities\Usuario');
    }
}

