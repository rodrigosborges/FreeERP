<?php

namespace Modules\ContaAPagar\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaModel extends Model
{
    use SoftDeletes;

    public $table = 'categoria_pagar';
    protected $fillable = ['id', 'nome'];
}
