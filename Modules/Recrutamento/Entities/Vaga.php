<?php

namespace Modules\Recrutamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaga extends Model
{
    use SoftDeletes;
    protected $table = 'vaga';
    public $timestamps = true;
    protected $fillable = array('id','cargo','salario','caracteristicas','descricao','escolaridade','status');

    public function curriculos(){

        return $this->hasMany('Modules\Recrutamento\Entities\Curriculo');

    }
}
