<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Papel extends Model
{
    
    use SoftDeletes;

    protected $table = 'papel';
    protected $fillable = ['nome'];

    public function modulo(){
        return $this->belongsToMany('Modules\Usuario\Entities\Modulo','papel_has_modulo');
    }
}
