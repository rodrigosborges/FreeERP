<?php

namespace Modules\ContaAPagar\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    public $table = 'categoria';
    protected $fillable = ['id', 'nome'];
}