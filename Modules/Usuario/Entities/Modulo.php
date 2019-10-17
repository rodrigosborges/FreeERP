<?php

namespace Modules\Usuario\Entities;

use Modules\Usuario\Entities\Usuario;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
    use SoftDeletes;
    protected $table = 'modulo';
    protected $fillable = ['nome', 'icone'];

    public function usuarios(){
        return $this->belongsToMany('Modules\Usuario\Entities\Usuario', 'usuario_has_modulo')
                    ->withPivot('papel_id');
    }
}
