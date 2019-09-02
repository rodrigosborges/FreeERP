<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoAcesso extends Model
{
    protected $table = 'tipo_acesso';

    protected $fillable = ['tipo'];
}
