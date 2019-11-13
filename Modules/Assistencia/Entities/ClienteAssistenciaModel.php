<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteAssistenciaModel extends Model
{
  use SoftDeletes;
  protected $table = 'cliente_assistencia';
  protected $fillable = ['id','nome','cpf','email','data_nascimento','celnumero','telefonenumero', 'endereco_id'];

  public function endereco(){ //relacionamento ao endereço (função que retorna o mesmo)
    return $this->belongsTo('App\Entities\Endereco');
  }
  public static function buscaCPF($busca){ //essa busca serve para a validação do cadastro
    return static::where('cpf', 'LIKE', '%'.$busca.'%')->paginate(10);
  }

}
