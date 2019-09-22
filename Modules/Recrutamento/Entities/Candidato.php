<?php

namespace Modules\Recrutamento\Entities;
use App\Entities\{Cidade,Email,Estado,Telefone,Endereco};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use SoftDeletes;
    protected $table = 'candidato';
    public $timestamps = true;
    protected $fillable = array('id','vaga_id','nome','curriculo','endereco_id','email_id','telefone_id','foto');

    public function email(){
        return $this->belongsTo('App\Entities\Email');
    }
    public function endereco(){
        return $this->belongsTo('App\Entities\Endereco');
    }
    public function telefone(){
        return $this->belongsTo('App\Entities\Telefone');
    }

    //Relação Com a tabela Vaga
    public function vaga(){
        return $this->belongsTo('Modules\Recrutamento\Entities\Vaga');
        
    }

    //Relação Com a tabela Mensagem
    public function mensagem(){
        return $this->HasMany('Modules\Recrutamento\Entities\Mensagem','mensagem_id');
        
    }



}
