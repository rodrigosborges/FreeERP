<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{   
    public $timestamps = false;
    protected $table = 'estado';
    protected $fillable = ['nome','abreviacao'];
}
