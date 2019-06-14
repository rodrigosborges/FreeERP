<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendario';
    protected $fillable = [];

    public  function eventos(){
        $this->hasMany('App\Evento');
    }
}
