<?php

namespace Modules\ControleUsuario\Entities;

use Illuminate\Database\Eloquent\Model;
use\Illuminate\Database\Eloquent\SoftDeletes;

class Papel extends Model
{
    use SoftDeletes;
    protected $table='papel';
    protected $fillable = ['nome','descricao','created_at','deleted_at'];
    public $timestamps=false;
    protected $dates = ['data'=> 'm-d-Y'];
 
    public function atuacoes()
    {
        return $this->hasMany('Modules\controleUsuario\Entities\Atuacao');
    }

    public function usuario()
    {
        return $this->belongsTo('Modules\controleUsuario\Entities\Usuario');
    }
}

