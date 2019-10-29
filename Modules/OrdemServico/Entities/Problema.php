<?php

namespace Modules\OrdemServico\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problema extends Model
{
    public $timestamps = false;
    protected $table = 'problema';
    protected $fillable = array('titulo');
}
