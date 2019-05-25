<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model{
    use SoftDeletes;

    protected $table = 'funcionario';

    protected $fillable = ['nome', 'data_nascimento', 'estado_civil_id', 'sexo', 'data_admissao'];

    public function estado_civil(){
        return $this->belongsTo('Modules\Funcionario\Entities\EstadoCivil');
    }

    // public function cargos(){
    //     return $this->hasMany('Modules\Funcionario\Entities\HistoricoCargo');
    // }

    public function cargos(){
        return $this->belongsToMany('Modules\Funcionario\Entities\Cargo', 'historico_cargo');
    }

    public function documentos(){
        return $this->hasMany('Modules\Funcionario\Entities\Documento');
    }

    //caso seja 1 pra 1
    public function enderecoRelacao(){
        return $this->hasOne('Modules\Funcionario\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','funcionario')
            ->where('tabela_destino','endereco');
    }

    public function endereco(){
        return $this->enderecoRelacao->dados();
    }

    //caso seja 1 pra n
    // public function enderecoRelacao(){
    //     return $this->hasMany('Modules\Funcionario\Entities\Relacao', 'origem_id')
    //         ->where('tabela_origem','funcionario')
    //         ->where('tabela_destino','endereco');
    // }

    // public function endereco(){
    //     $dados = [];
    //     foreach($this->enderecoRelacao as $relacao){
    //         $dados[] = $relacao->dados;
    //     }
    //     return $dados;
    // }
    
    public function contato(){
        return $this->hasOne('Modules\Funcionario\Entities\Contato');
    }

    public function setDataNascimentoAttribute($val){
        $this->attributes['data_nascimento'] = implode('-', array_reverse(explode('/', $val))) ? : '';
    }

    public function getDataNascimentoAttribute($val){
        return implode('/', array_reverse(explode('-', $val))) ? : '';
    }

    public function setDataAdmissaoAttribute($val){
        $this->attributes['data_admissao'] = implode('-', array_reverse(explode('/', $val))) ? : '';
    }

    public function getDataAdmissaoAttribute($val){
        return implode('/', array_reverse(explode('-', $val))) ? : '';
    }

    public function cpf() {
        return $this->documentos()->where('tipo', 'cpf');
    }

    public function rg() {
        return $this->documentos()->where('tipo', 'rg');
    }
    
}   