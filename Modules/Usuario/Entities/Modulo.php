<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulo';
    protected $fillable = ['nome', 'icone'];
}
