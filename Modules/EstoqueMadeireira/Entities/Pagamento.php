<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use SoftDeletes;
    protected $fillable = ['pedido_id', 'formaPagamento_id', 'valor'];
    protected $table = 'pagamentos';

    public function formaPagamento(){
    return $this->hasOne('Modules\EstoqueMadeireira\Entities\FormaPagamento')->withTrashed();

    }

    
}