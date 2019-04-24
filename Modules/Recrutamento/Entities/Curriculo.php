<?php

namespace Modules\Recrutamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculo extends Model
{
    use SoftDeletes;
    protected $table = 'curriculo';
    public $timestamps = true;
    protected $fillable = array('id','vaga_id','nome','email','formacao','endereco','telefone','experiencia');

}
