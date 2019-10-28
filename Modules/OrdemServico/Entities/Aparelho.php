<?php

namespace Modules\OrdemServico\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aparelho extends Model
{
    public $timestamps = true;
    protected $table = 'aparelho';
    protected $fillable = array('marca','numero_serie','tipo_aparelho','modelo','acessorios','inutilizacao');
}
