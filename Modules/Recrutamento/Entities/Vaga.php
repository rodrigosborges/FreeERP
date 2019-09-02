<?php

namespace Modules\Recrutamento\Entities;

use App\Entities\Endereco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaga extends Model
{
    use SoftDeletes;
    protected $table = 'vaga';
    public $timestamps = true;
    protected $fillable = array('id','cargo','salario','descricao','escolaridade','status','especificacoes');

    public function candidatos(){
        return $this->hasMany('Modules\Recrutamento\Entities\Candidado');
    }

    public function endereco(){
        return $this->belongsTo('App\Entities\Endereco');
    }
}
