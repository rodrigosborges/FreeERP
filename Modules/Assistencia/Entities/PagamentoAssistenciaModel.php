<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class PagamentoAssistenciaModel extends Model
{
    protected $table = 'pagamento_assistencia';
    protected $fillable = ['id','desconto','valor', 'status','idConserto']; 


    public function conserto(){
        return $this->belongsTo('Modules\Assistencia\Entities\ConsertoAssistenciaModel', 'idConserto');
    }
}
