<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class PagamentoAssistenciaModel extends Model
{
    protected $table = 'pagamento_assistencia';
    protected $fillable = ['id','valor', 'status','forma','idConserto', 'idCliente'];


    public function conserto(){//relacionamento ao conserto
      return $this->belongsTo('Modules\Assistencia\Entities\ConsertoAssistenciaModel', 'idConserto')->withTrashed();
    }

    public function cliente(){ //relacionamento ao cliente
        return $this->belongsTo('Modules\Assistencia\Entities\ClienteAssistenciaModel', 'idCliente')->withTrashed();
    }

}
