<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Aprovacao extends Model
{
    protected $fillable = [];
    protected $table = 'aprovacao';

    public function compartilhamento(){
        return $this->belongsTo('Modules\Calendario\Entities\Compartilhamento');
    }
}
