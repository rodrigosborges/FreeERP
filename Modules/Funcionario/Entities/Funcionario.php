<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Entities\{Documento};

class Funcionario extends Model{
    use SoftDeletes;

    protected $table = 'funcionario';

    protected $fillable = ['nome', 'data_nascimento', 'sexo', 'data_admissao'];

    public function cargos(){
        return $this->belongsToMany('Modules\Funcionario\Entities\Cargo', 'historico_cargo')->withPivot('data_entrada','data_saida')->withTrashed();
    }

    public function dependentes(){
        return $this->hasMany('Modules\Funcionario\Entities\Dependente');
    }

    // public function dependentesRelacao(){
    //     return $this->hasMany('App\Entities\Relacao', 'origem_id')
    //         ->where('tabela_origem','funcionario')
    //         ->where('tabela_destino','dependente');
    // }

    // public function dependentes(){
    //     $dados = [];
    //     foreach($this->dependentesRelacao as $relacao){
    //         $dados[] = $relacao->dados;
    //     }
    //     return $dados;
    // }

    public function estadoCivilRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','funcionario')
            ->where('tabela_destino','estado_civil');
    }

    public function estado_civil(){
        return $this->estadoCivilRelacao->dados;
    }

    public function documentosRelacao(){
        return $this->hasMany('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','funcionario')
            ->where('tabela_destino','documento');
    }

    public function documentos(){
        $dados = [];
        foreach($this->documentosRelacao as $relacao){
            $dados[] = $relacao->dados;
        }
        return $dados;
    }

    public function enderecoRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','funcionario')
            ->where('tabela_destino','endereco');
    }

    public function endereco(){
        return $this->enderecoRelacao->dados;
    }

    public function emailRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','funcionario')
            ->where('tabela_destino','email');
    }

    public function email(){
        return $this->emailRelacao->dados;
    }

    public function telefoneRelacao(){
        return $this->hasMany('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','funcionario')
            ->where('tabela_destino','telefone');
    }

    public function telefones(){
        $dados = [];
        foreach($this->telefoneRelacao as $relacao){
            $dados[] = $relacao->dados;
        }
        return $dados;
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
        return Documento::where('tipo_documento_id', 1)->join('relacao','documento.id','=','relacao.destino_id')->where('relacao.origem_id',$this->id)->where('relacao.tabela_origem','funcionario')->select('documento.*')->first();
    }

    public function rg() {
        return Documento::where('tipo_documento_id', 2)->join('relacao','documento.id','=','relacao.destino_id')->where('relacao.origem_id',$this->id)->where('relacao.tabela_origem','funcionario')->select('documento.*')->first();
    }
    
}   