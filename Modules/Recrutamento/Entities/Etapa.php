<?php

namespace Modules\Recrutamento\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etapa extends Model
{
    use SoftDeletes;
    protected $table = 'etapa';
    public $timestamps = true;
    protected $fillable = array('id','nome','descricao');
}
