<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class SituacaoOsModel extends Model
{
    protected $table = 'situacao_os_assistencia';
    protected $fillable = ['situacao', 'obs','idConserto'];


    public function conserto(){ //relacionamento ao conserto
      return $this->belongsTo('Modules\Assistencia\Entities\ConsertoAssistenciaModel', 'idConserto')->withTrashed();
    }
}
