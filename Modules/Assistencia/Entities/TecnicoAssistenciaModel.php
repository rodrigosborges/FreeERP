<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TecnicoAssistenciaModel extends Model
{
    use SoftDeletes;
    protected $table = 'tecnico_assistencia';
    protected $fillable = ['id','nome','cpf'];
}
