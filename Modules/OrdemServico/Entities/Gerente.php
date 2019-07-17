<?php

namespace Modules\OrdemServico\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gerente extends Model
{
    Use SoftDeletes;
    protected $table = 'gerente';
    public $timestamps = true;
    protected $fillable = array('id','nome');
}
