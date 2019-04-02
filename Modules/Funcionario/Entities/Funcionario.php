<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model{
    use SoftDeletes;

    protected $table = 'funcionario';

    protected $fillable = ['nome', 'data_nascimento', 'estado_civil_id', 'cargo_id', 'sexo', 'data_admissao'];

    public function estado_civil(){
        return $this->belongsTo('Modules\Funcionario\Entities\EstadoCivil');
    }

    public function cargos(){
        return $this->belongsToMany('Modules\Funcionario\Entities\Cargo', 'cargo_has_funcionario')->withTrashed();
    }

    public function documentos(){
        return $this->hasMany('Modules\Funcionario\Entities\Documento');
    }

    public function endereco(){
        return $this->hasOne('Modules\Funcionario\Entities\Endereco');
    }

    public function contato(){
        return $this->hasOne('Modules\Funcionario\Entities\Contato');
    }
    
}   