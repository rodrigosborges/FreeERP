<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = [];

    public function calendario(){
        return $this->belongsTo('App\Calendario');
    }
}
