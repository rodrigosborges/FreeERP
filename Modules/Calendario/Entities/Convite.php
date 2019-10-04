<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{
    protected $fillable = [];
    protected $table = 'convite';

    public function evento(){
        return $this->belongsTo('Modules\Calendario\Entities\Evento');
    }
}
