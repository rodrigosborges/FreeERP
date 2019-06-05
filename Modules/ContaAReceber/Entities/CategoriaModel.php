<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    public $table = 'categoria_receber';
    protected $fillable = ['id', 'nome','ativo'];
}
