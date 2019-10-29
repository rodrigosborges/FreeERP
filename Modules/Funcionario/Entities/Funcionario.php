<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Funcionario\Entities\Cargo;


class Funcionario extends Model {
    
    protected $table = 'funcionario';
    protected $fillable = ['nome', 'data_nascimento', 'sexo', 'data_admissao', 'cargo_id', 'situacao', 'estado_civil_id', 'email_id', 'endereco_id','foto'];
    use SoftDeletes;
    
    public function estado_civil(){
        return $this->belongsTo('App\Entities\EstadoCivil');
    }
    public function email(){
        return $this->belongsTo('App\Entities\Email');
    }
    public function endereco(){
        return $this->belongsTo('App\Entities\Endereco');
    }
    public function dependente(){
        return $this->hasMany('Modules\Funcionario\Entities\Dependente');
    }
    public function telefone(){
        return $this->belongsToMany('App\Entities\Telefone','funcionario_has_telefone','funcionario_id','telefone_id');
    }
    public function documento(){//NxN
        return $this->belongsToMany('App\Entities\Documento', 'funcionario_has_documento','funcionario_id','documento_id');
    }
    public function cargos(){
        return $this->belongsToMany('Modules\Funcionario\Entities\Cargo', 'historico_cargo')->withPivot('data_entrada','data_saida');
    }

    public function curso(){
        return $this->hasMany('Modules\Funcionario\Entities\Curso');
    }

    public function ferias(){
        return $this->hasMany('Modules\Funcionario\Entities\Ferias');
    }

    public function controle_ferias(){
        return $this->hasMany('Modules\Funcionario\Entities\ControleFerias');
    }

    public function Atestado(){
        return $this->hasMany('Modules\Funcionario\Entities\Atestado');
    }

    public function demissao(){
        return $this->hasOne('Modules\Funcionario\Entities\Demissao');
    }

    public function avisoPrevio(){
        return $this->hasOne('Modules\Funcionario\Entities\AvisoPrevio');
    }

    public function pagamento(){
        return $this->hasMany('Modules\Funcionario\Entities\Pagamento');
    }

}