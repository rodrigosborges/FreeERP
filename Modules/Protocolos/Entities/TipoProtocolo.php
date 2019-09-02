<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoProtocolo extends Model
{
    protected $table = 'tipo_protocolo';

    protected $fillable = ['tipo'];

}
