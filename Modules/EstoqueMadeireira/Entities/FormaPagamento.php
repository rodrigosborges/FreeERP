<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class formaPagamento extends Model
{
    protected $fillable = ['nome', 'taxa', 'preco'];
    protected $table = 'forma_pagamentos';


    public function pagamento(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Pagamento')->withTrashed();

    }

}
