<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Modulo extends Model
{
    use SoftDeletes;
    protected $table='modulo';
    protected $fillable = ['nome', 'icone'];
    public $timestamps=false;

    public function atuacoes()
    {
        return $this->hasMany('Modules\controleUsuario\Entities\Atuacao');
    }
}
