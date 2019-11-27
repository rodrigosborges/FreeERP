<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use App\Entities\{Documento};

class Dependente extends Model{
   
    protected $table = 'dependente';

    protected $fillable = ['nome', 'mora_junto', 'certidao_matricula', 'certidao_vacina', 'parentesco_id', 'funcionario_id', 'cpf'];

    public $timestamps = false;

    public function parentesco(){
        return $this->belongsTo('Modules\Funcionario\Entities\Parentesco','parentesco_id');
    }

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario', 'funcionario_id');
    }


    public function getNomeParentesco() {
        return Parentesco::find($this->parentesco_id)->nome;
    }
}