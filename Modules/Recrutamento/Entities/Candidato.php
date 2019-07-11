<?php

namespace Modules\Recrutamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use SoftDeletes;
    protected $table = 'candidato';
    public $timestamps = true;
    protected $fillable = array('id','vaga_id','nome','curriculo');

    //Relação com tabela Telefone
    public function telefoneRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','candidato')
            ->where('tabela_destino','telefone');
    }
    public function telefones(){
        return $this->telefoneRelacao->dados();
    }
    //Relação com tabela Email
    public function emailRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','candidato')
            ->where('tabela_destino','email');
    }
    public function email(){
        return $this->emailRelacao->dados();
    }


    //Relação Com a tabela Vaga
    public function vaga(){
        return $this->belongsTo('Modules\Recrutamento\Entities\Vaga','vaga_id');
        
    }



}
