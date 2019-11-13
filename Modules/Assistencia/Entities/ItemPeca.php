<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemPeca extends Model {
    protected $table = 'item_peca_assistencia';
    protected $fillable = ['id','idPeca'];

    public function peca(){ //relacionamento a peça
        return $this->belongsTo('Modules\Assistencia\Entities\PecaAssistenciaModel', 'idPeca')->withTrashed();
    }
    
}
