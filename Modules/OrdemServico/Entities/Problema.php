<?php

namespace Modules\OrdemServico\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problema extends Model
{
    Use SoftDeletes;
    protected $table = 'problema';
    public $timestamps = true;
    protected $fillable = array('id','titulo','prioridade');
}
