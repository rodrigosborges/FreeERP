<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use App\Entities\{Documento};

class Dependente extends Model{
   
    protected $table = 'dependente';

    protected $fillable = ['nome', 'mora_junto', 'parentesco_id', 'funcionario_id', 'certidao_matricula'];

    public $timestamps = false;

    public function parentesco(){
        return $this->belongsTo('Modules\Funcionario\Entities\Parentesco','parentesco_id');
    }

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario', 'funcionario_id');
    }

    public function cpf() {
        return Documento::where('tipo_documento_id', 1)->join('relacao','documento.id','=','relacao.destino_id')->where('relacao.origem_id',$this->id)->where('relacao.tabela_origem','dependente')->select('documento.*')->first();
    }

    public function getNomeParentesco() {
        return Parentesco::find($this->parentesco_id)->nome;
    }
}