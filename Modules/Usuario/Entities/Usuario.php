<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model{
    
    use SoftDeletes;

    protected $table = 'usuario';
    protected $fillable = ['apelido', 'avatar', 'email', 'password'];
}
