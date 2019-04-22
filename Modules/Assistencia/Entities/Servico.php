<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['id','nome','valor'];
}
