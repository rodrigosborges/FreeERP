<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaModel extends Model
{
    use SoftDeletes;
    public $table = 'categoria_receber';
    protected $fillable = ['id', 'nome'];
}
