<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class peca extends Model
{
    protected $fillable = ['id','nome','valor'];
}
