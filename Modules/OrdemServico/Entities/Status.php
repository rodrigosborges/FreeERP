<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    protected $table = 'status';
    protected $fillable = array('titulo');
}
