<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
    use SoftDeletes;
    protected $table = 'modulo';
    protected $fillable = ['nome', 'icone'];

    public function papeis(){
        return $this->belongsToMany('Modules\Usuario\Entities\Papel','papel_has_modulo');
    }
}
