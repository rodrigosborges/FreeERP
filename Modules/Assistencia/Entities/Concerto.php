<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class concerto extends Model
{
    protected $fillable = ['id','modelo_aparelho','marca_aparelho','serial_aparelho','imei_aparelho','cliente_id','peca_id','mao_obra_id'];
}
