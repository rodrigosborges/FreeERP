<?php

namespace Modules\Recrutamento\Entities;

use App\Entities\Endereco;
use Modules\Recrutamento\Entities\{Vaga,Candidato,Cargo,Categoria,Beneficio};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaga extends Model
{
    use SoftDeletes;
    protected $table = 'vaga';
    public $timestamps = true;
    protected $fillable = array('id','cargo_id','salario','descricao','escolaridade','status','especificacoes','regime','interessado_nome','interessado_email');

    public function candidatos(){
        return $this->hasMany('Modules\Recrutamento\Entities\Candidado');
    }

    public function endereco(){
        return $this->belongsTo('App\Entities\Endereco');
    }

    public function cargo(){
        return $this->belongsTo('Modules\Recrutamento\Entities\Cargo')->withTrashed();
    }

    public function beneficios(){
        return $this->belongsToMany('Modules\Recrutamento\Entities\Beneficio','vaga_has_beneficio');   
    }

}
