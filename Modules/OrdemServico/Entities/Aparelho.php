<?php

namespace Modules\OrdemServico\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aparelho extends Model
{
    public $timestamps = false;
    protected $table = 'aparelho';
    protected $fillable = array('marca','tipo_aparelho','modelo','acessorios','inutilizacao');
}
