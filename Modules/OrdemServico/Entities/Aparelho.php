<?php

namespace Modules\OrdemServico\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aparelho extends Model
{
    Use SoftDeletes;
    protected $table = 'aparelho';
    public $timestamps = true;
    protected $fillable = array('id','marca','numero_serie');
}
