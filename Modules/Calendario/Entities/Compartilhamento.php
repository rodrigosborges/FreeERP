<?php

namespace Modules\Calendario\Entities;

use Illuminate\Database\Eloquent\Model;

class Compartilhamento extends Model
{
    protected $table = 'compartilhamento';
    protected $fillable = ['setor_id', 'agenda_id'];

    public function agenda(){
        return $this->belongsTo('Modules\Calendario\Entities\Evento');
    }

    public function setor(){
        return $this->belongsTo('Modules\Calendario\Entities\Setor');
    }
}
