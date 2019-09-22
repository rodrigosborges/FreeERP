<?php

namespace Modules\Recrutamento\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categoria';
    public $timestamps = true;
    protected $fillable = array('id','nome');
}
