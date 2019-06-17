<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = ['nome', 'data_hora', 'descricao'];

    public function calendario(){
        return $this->belongsTo('Modules\Calendario\Entities\Calendario');
    }
}
