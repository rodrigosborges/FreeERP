<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletets;

class Papel extends Model
{
    use SoftDeletets;
    protected $table='papel';
    protected $fillable = ['nome'];
    protected $timestamps=false;

    public function atuacoes()
    {
        return $this->hasMany('Modules\controleUsuario\Entities\Atuacao');
    }
}