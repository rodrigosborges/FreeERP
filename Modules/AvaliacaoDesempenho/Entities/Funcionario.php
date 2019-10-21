<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model {
    
    protected $table = 'funcionario';
    protected $fillable = ['nome', 'data_nascimento', 'sexo', 'data_admissao', 'estado_civil_id', 'email_id', 'endereco_id', 'cargo_id', 'setor_id'];
    use SoftDeletes;
    
    public function estado_civil() {
        return $this->belongsTo('App\Entities\EstadoCivil');
    }

    public function email() {
        return $this->belongsTo('App\Entities\Email');
    }

    public function endereco() {
        return $this->belongsTo('App\Entities\Endereco');
    }

    public function telefone() {
        return $this->belongsToMany('App\Entities\Telefone', 'funcionario_has_telefone', 'funcionario_id', 'telefone_id');
    }

    public function documento() {
        return $this->belongsToMany('App\Entities\Documento', 'funcionario_has_documento', 'funcionario_id', 'documento_id');
    }

    public function cargo() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Cargo', 'cargo_id');
    }

    public function setor() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Setor', 'setor_id');
    }

    public function processos() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Processo', 'funcionario_id', 'id');
    }

    public function avaliacoesResponsavel() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'funcionario_id', 'id');
    }

    public function avaliacoesAvaliador() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliador', 'funcionario_id', 'id');
    }

    public function avaliacoesAvaliado() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliado', 'funcionario_id', 'id');
    }
}