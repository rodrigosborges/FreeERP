<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;
use\Illuminate\Database\Eloquent\SoftDelets;

class Usuario extends Model
{
    use SoftDeletes;
    protected $table='usuario';
    protected $fillable = ['foto', 'nome', 'email', 'senha'];
    protected $timestamps=false;

    public function atuacoes()
    {
        return $this-> hasMany('Modules\controleUsuario\Entities\Atuacao');
    }


    
}

