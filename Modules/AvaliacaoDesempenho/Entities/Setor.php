<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setor extends Model
{
    protected $table = 'setor';
    protected $fillable = ['nome'];
    use SoftDeletes;
}
