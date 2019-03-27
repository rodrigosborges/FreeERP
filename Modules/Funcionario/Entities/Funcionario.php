<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model{
    use SoftDeletes;

    protected $table = 'funcionario';

    protected $fillable = ['nome', 'data_nascimento', 'estado_civil_id', 'cargo_id', 'sexo', 'data_admissao'];

    public function estado_civil(){
        return $this->belongsTo('App\EstadoCivil');
    }

    public function cargos(){
        return $this->belongsToMany('App\Cargo', 'cargo_has_funcionario');
    }

    public function documento(){
        return $this->hasOne('App\Documento');
    }

    public function endereco(){
        return $this->hasOne('App\Endereco');
    }

    public function contato(){
        return $this->hasOne('App\Contato');
    }
    
}   