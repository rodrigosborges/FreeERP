<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class TecnicoAssistenciaModel extends Model
{
    protected $table = 'tecnico_assistencia';
    protected $fillable = ['id','nome','cpf','ativo'];
}
